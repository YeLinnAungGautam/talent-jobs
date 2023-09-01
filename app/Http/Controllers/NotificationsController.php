<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\User;
use Response;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    { 
        $user = User::findOrFail($id);

        
        $notification = Notifications::with("job","job.location","job.category")->where('user_id',$id)->orderBy('id', 'DESC')->get();

            if(count($notification) <= 0){
                return  Response::json([
                    'message ' => "No Data Found"
                ], 404);
            }
            else{
                return $notification;
            }
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
            'title' => 'required|string',
            'body'  => 'required|string',
            'user_id' => 'required'
        ]);
        $notification= Notifications::create([
            'title' => $fields['title'],
            'body'  => $fields['body'],
            'user_id' => $fields['user_id']
        ]);
        if($notification){
            return response()->json([
                'status' => 'success',  
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
        $success = Notifications::find($id);
        $success->delete();
        return response([
            'success' => 'Deleted Successful'
        ], 201);
    }
}
