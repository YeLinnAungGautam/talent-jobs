<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
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
        //
    }

    public function register(Request $request){
        global $fileName;
        global $fileName_forcv;
            $fields = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'role' => 'required|string',
                'nrc'  => 'nullable|string',
                'address' => 'nullable|string',
                'cv_file' => 'nullable|mimes:pdf',
                'profile_picture' => 'nullable|mimes:jpeg,png',
                'password' => 'required|string|confirmed',
                'phonenumber' => 'nullable',
            ]);
            // $profile_pictures = $request->file('profile_picture');
            // $profile_pictures = $request->file('profile_picture')->store('public/uploads/profile_pictures');
            //For Profile Pictures
            if($request->hasFile('cv_file') == null){
                $fileName = '-';
            }
            else{
                $destinationPath = public_path().'/profile_images';
                $request->file = $request->file('cv_file')->getClientOriginalName();
                $fileName = $request->file('cv_file')->getClientOriginalName(); 
                $request->file('cv_file')->move($destinationPath,$fileName);
            }
            if($request->hasFile('profile_picture') == null){
                $fileName_forcv = '-';
            }
            else{
            //For CV Files
            $destinationPath_forcv = public_path().'/profile_images';
            $request->file = $request->file('profile_picture')->getClientOriginalName();
            $fileName_forcv = $request->file('profile_picture')->getClientOriginalName(); 
            $request->file('profile_picture')->move($destinationPath_forcv,$fileName_forcv);
        }
            // $cv_file = $request->file('cv_file')->store('public/uploads/cv_files');
            $user = User::create([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'phonenumber' => '-',
                'password' => bcrypt($fields['password']),
                'role' => $fields['role'],
                'nrc' => '-',
                'address' => '-',
                'cv_file' => $fileName,
                'profile_picture' => $fileName_forcv
            ]);
            $token = $user->createToken('myapptoken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return response($response, 201);
    }
    public function loginwithemail(Request $request){
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        //Check Email
        $user = User::where('email', $fields['email'])->first();
        //Check Password 
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Bad Credentials'
            ], 401);
        }
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    } 
    public function loginwithphonenumber(Request $request){
        $fields = $request->validate([
            'phonenumber' => 'required|string',
            'password' => 'required|string'
        ]);
        //Check PhoneNumber
        $user = User::where('phonenumber', $fields['phonenumber'])->first();
        //Check Password 
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Wrong Password'
            ], 401);
        }
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }
    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return[
            'message' => 'You Are Logged Out'
        ];
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return $user;
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
        // $user_id = User::findorFail($id);
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'nrc'  => 'required|string',
            'address' => 'required|string',
            'cv_file' => 'nullable|mimes:pdf',
            'profile_picture' => 'nullable|mimes:jpeg,png',
            'password' => 'required|string|confirmed',
            'phonenumber' => 'required',
        ]);
        $user_update = User::find($id);
        if($request->hasFile('cv_file') == null){
            $fileName = '-';
        }
        else{
            $destinationPath = public_path().'/profile_images';
            $request->file = $request->file('cv_file')->getClientOriginalName();
            $fileName = $request->file('cv_file')->getClientOriginalName(); 
            $request->file('cv_file')->move($destinationPath,$fileName);
        }
        if($request->hasFile('profile_picture') == null){
            $fileName_forcv = '-';
        }
        else{
        //For CV Files
        $destinationPath_forcv = public_path().'/profile_images';
        $request->file = $request->file('profile_picture')->getClientOriginalName();
        $fileName_forcv = $request->file('profile_picture')->getClientOriginalName(); 
        $request->file('profile_picture')->move($destinationPath_forcv,$fileName_forcv);
    }
        // $cv_file = $request->file('cv_file')->store('public/uploads/cv_files');
        $user_update->update([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'phonenumber' => $fields['phonenumber'],
            'password' => bcrypt($fields['password']),
            'role' => $fields['role'],
            'nrc' => $fields['nrc'],
            'address' => $fields['address'],
            'cv_file' => $fileName,
            'profile_picture' => $fileName_forcv
        ]);
        return [
            'message' => 'Updated Successfully'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $userid)
    {
        $success = $userid->delete();
        return [
            'success' => $success
        ];
    }
}
