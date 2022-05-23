<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobs;
use App\Models\Location;
use App\Models\JobCategory;
use DB;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $jobs = DB::table('jobs')
               ->join('locations','jobs.location_id','=','locations.id')
               ->join('job_categories','jobs.category_id','=','job_categories.id')
               ->select('jobs.*','locations.location','jobs.*','job_categories.name')
               ->get();
        // $jobs = Jobs::all();
        return $jobs;
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
        
        $job= Jobs::create([
            'job_title' => $fields['job_title'],
            'job_description' => $fields['job_description'],
            'qualification' =>$fields['qualification'],
            'location_id' =>$location_id->id,
            'category_id' =>$category_id->id,
            'salary' => $fields['salary'],
            'township' => '-',
            'experiences' => $fields['experiences'],
            'responsibilities' => $fields['responsibilities']
        ]);
        if($job){
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
            $jobs = Jobs::with('jobsmodel','jobscategoriesmodel')->where('id',$id)->first();
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
            'township' => 'required|string',
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
            'location_id' =>$fields['location_id'],
            'category_id' =>$fields['category_id'],
            'salary' => $fields['salary'],
            'township' => $fields['township'],
            'experiences' => $fields['experiences'],
            'responsibilities' => $fields['responsibilities']
        ]);
        return response([
            'message' => 'Update Successfully'
        ], 200);
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
        $success->delete();
        return [
            'success' => 'Deleted Successful'
        ];
    }
    public function searchjobs($name){
        // $search_key_word = preg_replace('/\s+/', '', $name);
        $jobs = Jobs::where('job_title','like','%'.$name.'%')
                ->orWhere('job_description','like','%'.$name.'%')
                ->orWhere('location','like','%'.$name.'%')
                ->orWhere('name','like','%'.$name.'%')
                ->join('locations','jobs.location_id','=','locations.id')
                ->join('job_categories','jobs.category_id','=','job_categories.id')
                ->select('jobs.*','locations.location','jobs.*','job_categories.name')
                ->paginate(6);
        return $jobs;
    }
}
