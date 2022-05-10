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
               ->select('jobs.*','locations.location')
               ->get();
        // $jobs = Jobs::with('jobsmodel')->get();
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
            'necessary_skills'=> 'required',
        ]);
        $location_id = Location::findOrfail($request->location_id);
        $category_id = JobCategory::findOrfail($request->category_id);
        
        $job= Jobs::create([
            'job_title' => $fields['job_title'],
            'job_description' => $fields['job_description'],
            'necessary_skills' =>$fields['necessary_skills'],
            'location_id' =>$location_id->id,
            'category_id' =>$category_id->id,
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
