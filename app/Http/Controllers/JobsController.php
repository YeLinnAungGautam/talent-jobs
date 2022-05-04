<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobs;
use App\Models\Location;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Jobs::with('jobsmodel','jobscategoriesmodel')->get();
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
            'pictures' => 'required|mimes:jpeg,png',
        ]);
        $job_pictures = $request->file('pictures')->store('public/uploads/job_pictures');
        $job= Jobs::create([
            'job_title' => $fields['job_title'],
            'job_description' => $fields['job_description'],
            'necessary_skills' =>$fields['necessary_skills'],
            'pictures' => $job_pictures,
            'location_id' =>2,
            'category_id' =>1,
        ]);
        if($job){
            return response()->json([
                'status' => 'success',
                'data' =>  $job
            ]);
        }
        return response([
            'message' => 'Created Successful'
        ], 401);
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
