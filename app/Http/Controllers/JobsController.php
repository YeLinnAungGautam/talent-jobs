<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobs;
use App\Models\Location;
use App\Models\JobCategory;
use App\Models\EmailSender;
use App\Models\ClosedVacnacy;
use App\Models\User;
use App\Models\PushNotification;
use App\Models\ApplyJob;
use App\Models\Notifications;
use Response;
use DB;

class JobsController extends Controller
{

    public function bulksend($id,$jobObj){
        $title = "Talent and Jobs Created a new Job Position";
        $body = "Check out what job position that you can serve for";
        $img = "logo.png";
        $comment = new PushNotification();
        $comment->title ="Talent and Jobs Created a new Job Position";
        $comment->body = "Check out what job position that you can serve for";
        $comment->image = "logo.png";
        $comment->save();

        $message = [
        "job"=>$jobObj,
        "type"=>"job"];

        $url = 'https://fcm.googleapis.com/fcm/send';
        $dataArr = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK','status'=>"done" , "payload"=>$message);
        $notification = array('title' =>$title, 'body' => $body, 'data'=>  $body, 'sound' => 'default', 'badge' => '1',);
        $arrayToSend = array('to' => "/topics/myTopic", 'notification' => $notification, 'data' => $dataArr, 'priority'=>'high');
        $fields = json_encode ($arrayToSend);
        $headers = array (
            'Authorization: key=' . "AAAAHSrCVjw:APA91bF1emPvEP6-FAuaVwW5x1ju-mb_6ltmw-Ppx40gG_D0UShFhyPEE6FpeaCpDXF4yghOH965vsP0H4vxEaf4-LBS5i-a0WPP07nIaQuweF16vjn2H-OIBoKQpB6UHQwlEzvT7I1F",
            'Content-Type: application/json'
        );

        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

        $result = curl_exec ( $ch );
        //var_dump($result);
        curl_close ( $ch );
      
        return $result;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $jobs = DB::table('jobs')
                ->where('isActive', true)
                ->where('isTrash', false)
                ->orderBy('id', 'DESC')
                ->join('locations','jobs.location_id','=','locations.id')
                ->join('job_categories','jobs.category_id','=','job_categories.id')
                ->select('jobs.*','locations.location','jobs.*','job_categories.name')
                ->get();
       
        if(count($jobs) <= 0)
        {
            return  Response::json([
                'message ' => "No Jobs Found"
            ],404);
        }
        else{
            return $jobs;
        }
    } 

    public function closeJobs()
    {
       $jobs = DB::table('jobs')
                ->where('isActive', false)
                ->orderBy('id', 'DESC')
                ->join('locations','jobs.location_id','=','locations.id')
                ->join('job_categories','jobs.category_id','=','job_categories.id')
                ->select('jobs.*','locations.location','jobs.*','job_categories.name')
                ->get();
        return $jobs;
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function creators()
    {
        //
      $test =  EmailSender::with("totalCancelJob")->get();
    //    $test = ClosedVacnacy::join('closed_vacnacies', 'closed_vacnacies.job_id', '=', 'jobs.id')
    //     ->groupBy('jobs.id')
    //     ->get(['jobs.id', 'jobs.job_title', DB::raw('count(closed_vacnacies.id) as items')]);

       return $test;
        
    }

    public function readAndRemain(){
        $readJobs = Jobs::where('isRead',true)->count();
        $remainJobs = Jobs::where('isRead',false)->count();
        $activeJobs = Jobs::where('isActive',true)->count();
        $inActiveJobsByTnj = Jobs::where([['isActive',false],['isTnj',true]])->count();
        $inActiveJobsByOthers = Jobs::where([['isActive',false],['isTnj',false]])->count();
        $readInbox = ApplyJob::where('isRead',true)->count();
        $unReadInbox = ApplyJob::where('isRead',false)->count();

        return  Response::json([
            'readJobs' => $readJobs,
            'remainJobs' => $remainJobs,
             'activeJobs' => $activeJobs,
             'inActiveJobs' => $inActiveJobsByTnj,
             'inActiveJobsOthers' => $inActiveJobsByOthers,
             'readInboxes' => $readInbox,
             'unReadInboxes' => $unReadInbox
        ], 200);
    }

    public function close(Request $request, $id)
    {
        if($request->isTnj){
            $job = Jobs::findOrFail($id);
            error_log($request->user_id);
            $user = EmailSender::findOrfail($request->user_id);       
    
            ClosedVacnacy::create([
                'user_id' => $user->id,
                'job_id' => $job->id
            ]);
    
            $job->isActive = false;
            $job->save();
            return  Response::json([
                'message ' => "Successfully Updated"
            ],200);
        }
        else{
            $job = Jobs::findOrFail($id);
    
            $job->isActive = false;
            $job->isTnj = false;
            $job->save();
            return  Response::json([
                'message ' => "Successfully Updated"
            ],200);
        }
       
    }

    public function read($id)
    {
        $job = jobs::findOrFail($id);
        $job->isRead = true;
        $job->save();
       
        return  Response::json([
            'message ' => "Successfully Updated"
        ],200);
    }

    public function updateJob($id,Request $request)
    {
        $job = jobs::where('job_unique_id',$id)->update(["open_in_link"=>$request->open_in_link]);
        // $job->open_in_link = $request->open_in_link;
        // $job->save();
       
        return  Response::json([
            'message ' => "Successfully Updated"
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'job_title' => 'required|string',
            'job_description' => 'required|string',
            'qualification'=> 'required',
            'salary' => 'required|string',
            'township' => 'nullable|string',
            'experiences' => 'required|string',
            'responsibilities' => 'required|string'
        ]);
        $location_id = Location::findOrfail($request->location_id);
        $category_id = JobCategory::findOrfail($request->category_id);
        $email = EmailSender::findOrfail($request->email_receiver);
        
        $job= Jobs::create([
            'job_title' => $fields['job_title'],
            'job_description' => $fields['job_description'],
            'qualification' =>$fields['qualification'],
            'location_id' =>$location_id->id,
            'category_id' =>$category_id->id,
            'email_receiver' =>$email->id,
            'salary' => $fields['salary'],
            'township' => '-',
            'experiences' => $fields['experiences'],
            'responsibilities' => $fields['responsibilities'],
            'job_unique_id' => $request->job_unique_id,
            'sharable_link' => $request->sharable_link
        ]);
            
        $lastJob = DB::table('jobs')
                ->where('jobs.id', $job->id)
                ->orderBy('id', 'DESC')
                ->join('locations','jobs.location_id','=','locations.id')
                ->join('job_categories','jobs.category_id','=','job_categories.id')
                ->select('jobs.*','locations.location','jobs.*','job_categories.name')
                ->first();
        
        if($job){
            // $this->bulksend($job->id,$lastJob);
            return response()->json([
                'status' => 'success',
                'data' =>  $job
            ]);
        }
        
        return response([
            'message' => 'Created Successful'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {
            $jobs = Jobs::with('location','category','emailsender')->where('id',$id)->first();
            return $jobs;
    } 

    public function showDetail($id) 
    {
            $jobs = Jobs::with('location','category','emailsender')->where('job_unique_id',$id)->first();
            return $jobs;
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function getJobsInTrash()
    {
        $jobsInTrash = DB::table('jobs')
                        ->where('isTrash', true)
                        ->orderBy('id', 'DESC')
                        ->join('locations','jobs.location_id','=','locations.id')
                        ->join('job_categories','jobs.category_id','=','job_categories.id')
                        ->select('jobs.*','locations.location','jobs.*','job_categories.name')
                        ->get();
        return $jobsInTrash;
    }

    public function recoverFromTrash($id){
        $job = Jobs::findOrFail($id);
        $job->isTrash = false;
        $job->isRead = false;
        $job->save();
        return response([
            'message' => 'Created Successful'
        ], 200);
    }

    public function putJobInTrash($id)
    {
        $job = Jobs::findOrFail($id);
        $job->isTrash = true;
        $job->save();
        return response([
            'message' => 'Created Successful'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $fields = $request->validate([
            'job_title' => 'required|string',
            'job_description' => 'required|string',
            'qualification'=> 'required',
            'salary' => 'required|string',
            'township' => 'string',
            'experiences' => 'required|string',
            'responsibilities' => 'required|string',
            'location_id' => 'required',
            'category_id' => 'required'
        ]);
        $job_update = Jobs::find($id);
        $job_update->update([
            'job_title' => $fields['job_title'],
            'job_description' => $fields['job_description'],
            'qualification' =>$fields['qualification'],
            'location_id' =>$request['location_id'],
            'category_id' =>$request['category_id'],
            'email_receiver' =>$request['email_receiver'],
            'salary' => $fields['salary'],
            'township' => $fields['township'],
            'experiences' => $fields['experiences'],
            'responsibilities' => $fields['responsibilities']
        ]);
        return response([
            'message' => 'Update Successfully'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $success = Jobs::find($id);
        ApplyJob::where('job_id',$success->id)->delete();
        Notifications::where('job_id',$success->id)->delete();
        $success->delete();
        return [
            'success' => 'Deleted Successful'
        ];
    }
    // public function searchjobs($name){
    //     // $search_key_word = preg_replace('/\s+/', '', $name);
    //     $jobs = Jobs::where('job_title','like','%'.$name.'%')
    //             ->orWhere('job_description','like','%'.$name.'%')
    //             ->orWhere('location','like','%'.$name.'%')
    //             ->orWhere('name','like','%'.$name.'%')
    //             ->join('locations','jobs.location_id','=','locations.id')
    //             ->join('job_categories','jobs.category_id','=','job_categories.id')
    //             ->select('jobs.*','locations.location','jobs.*','job_categories.name')
    //             ->paginate(6);
    //     return $jobs;
    // }
    public function searchjobsquery(Request $request){
        // $search_key_word = preg_replace('/\s+/', '', $name);
        $jobposition = $request->jobposition ;
        $location = $request->location ;
        $jobcategory = $request->jobcategory;
        $salary = $request->salary;
    
  
        if($location == 'All' && $salary=="All" && $jobcategory!= "All"){
            
            $jobs = Jobs::where('name','like','%'.$jobcategory.'%')  
                ->join('locations','jobs.location_id','=','locations.id')
                ->join('job_categories','jobs.category_id','=','job_categories.id')
                ->select('jobs.*','locations.location','jobs.*','job_categories.name')
                ->get();
                if(count($jobs) <= 0){
                    return  Response::json([
                        'message ' => "No Data Found"
                    ], 404);
                }
                else{   
                    return $jobs;
                }
        }
        if($location == 'All' && $jobcategory == 'All' && $salary == "All" && $jobposition == ''){
            
            $jobs = DB::table('jobs')
            ->join('locations','jobs.location_id','=','locations.id')
            ->join('job_categories','jobs.category_id','=','job_categories.id')
            ->select('jobs.*','locations.location','jobs.*','job_categories.name')
            ->get();
                if(count($jobs) <= 0){
                    return  Response::json([
                        'message ' => "No Data Found"
                    ], 404);
                }
                else{   
                    return $jobs;
                }
        }
        if($jobposition != '' && $location == 'All' && $jobcategory == 'All' && $salary == "All"){
            
            $jobs = Jobs::where('job_title','like','%'.$jobposition.'%')   
            ->join('locations','jobs.location_id','=','locations.id')
            ->join('job_categories','jobs.category_id','=','job_categories.id')
            ->select('jobs.*','locations.location','jobs.*','job_categories.name')
            ->get();
            if(count($jobs) <= 0){
                return  Response::json([
                    'message ' => "No Data Found"
                ], 404);
            }
            else{   
                return $jobs;
            }
        }
        if($jobposition == '' && $location != 'All'){
            
            $jobs = Jobs::where('location','like','%'.$location.'%')                
                ->join('locations','jobs.location_id','=','locations.id')
                ->join('job_categories','jobs.category_id','=','job_categories.id')
                ->select('jobs.*','locations.location','jobs.*','job_categories.name')
                ->get();
                if(count($jobs) <= 0){
                    return  Response::json([
                        'message ' => "No Data Found"
                    ], 404);
                }
                else{   
                    return $jobs;
                }
        }
        if($salary != "All"){

            if (str_contains($salary, '+')) { 
                $salaryArr = explode("+",$salary);
                $minimalSalary = $salaryArr[0];
                echo "oh noo";
                $jobs = Jobs::where('salary', '>=', $minimalSalary)              
                    ->join('locations','jobs.location_id','=','locations.id')
                    ->join('job_categories','jobs.category_id','=','job_categories.id')
                    ->select('jobs.*','locations.location','jobs.*','job_categories.name')
                    ->get();
                    if(count($jobs) <= 0){
                        return  Response::json([
                            'message ' => "No Data Found"
                        ], 404);
                    }
                    else{   
                        return $jobs;
                    }
            }

            else{ 

                $salaryArr = explode("-",$salary);
                $minimalSalary = $salaryArr[0];
                $maximumSalary = $salaryArr[1];
                
                $jobs = Jobs::where('salary', '>=', $minimalSalary)->where('salary', '<=', $maximumSalary)               
                    ->join('locations','jobs.location_id','=','locations.id')
                    ->join('job_categories','jobs.category_id','=','job_categories.id')
                    ->select('jobs.*','locations.location','jobs.*','job_categories.name')
                    ->get();
                    if(count($jobs) <= 0){
                        return  Response::json([
                            'message ' => "No Data Found"
                        ], 404);
                    }
                    else{   
                        return $jobs;
                    }
            }
        }
      
        else{
           
            $jobs = Jobs::where('job_title','like','%'.$jobposition.'%')
                ->orWhere('location','like','%'.$location.'%')
                ->orWhere('name','like','%'.$jobcategory.'%')
                ->join('locations','jobs.location_id','=','locations.id')
                ->join('job_categories','jobs.category_id','=','job_categories.id')
                ->select('jobs.*','locations.location','jobs.*','job_categories.name')
                    ->get();
            if(count($jobs) <= 0){
                return  Response::json([
                    'message ' => "No Data Found"
                ], 404);
            }
            else{   
                return $jobs;
            }
            
        }
    }
}
