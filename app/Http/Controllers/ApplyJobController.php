<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Jobs;
use App\Models\User;
use App\Models\ApplyJob;
use App\Models\EmailSender;

class ApplyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user_apply_job = ApplyJob::with('ApplyJobdesignation','ApplyJobdesignation','ApplyJobUserModel','ApplyJobListModel','ApplyJobListModel.jobsmodel','ApplyJobListModel.jobscategoriesmodel')->get();
        $applyJobs = ApplyJob::with('ApplyJobdesignation','job', 'userApply','job.location','job.category')->get();
        return $applyJobs;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($userid,$jobid)
    {
        $user_id = User::findOrfail($userid);
        $job_list = Jobs::findorfail($jobid);
        $applyjob= ApplyJob::create([
            'user_id' => $user_id->id,
            'job_id' => $job_list->id,
        ]);
        $job_list = Jobs::with('location','category')->where('id',$jobid)->get();
        $job_email_to_sent = Jobs::with('emailsender')->where('id',$jobid)->get(['email_receiver']);
        // foreach ($job_email_to_sent as $emailsender_applyjob) {
        //         $emailsender_applyjob->sender_email;
        // }
        return $job_email_to_sent;
        // $find_email = EmailSender::where('id',$job_email_to_sent)->get(['sender_email']);
        // \Mail::to(auth()->user()->email)->send(new Sendmail($job_list));
        // \Mail::to($job_email_to_sent->email_receiver)->send(new Sendmail($job_list));
        // if($applyjob){
        //     return response()->json([
        //         'status' => 'success',
        //     ]);
        // }
        // return $job_email_to_sent;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
