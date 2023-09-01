<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
use App\Models\User;
use Carbon\Carbon;
use DB;

class ResetPasswordController extends Controller
{
    //
    public function passwordforgot(){
        return view('resetpassword.forgotpassword');
    }
    public function forgotPassword(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
        ]);
            $email = $request->get('email');
            $checkemail = User::where('email',$email)->first();
            if($checkemail){
                $token = \Str::random(64);
                //Create Password Reset Token
                DB::table('password_resets')->insert([
                    'email' => $email,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
                $user = User::where('email',$email)->first();
                $status = 'http://127.0.0.1:8000/reset-password/?token='.$token.'&email='.$email;
                \Mail::to("selfstudydeveloper@gmail.com")->send(new ResetPassword($status)); 
                return view('resetpassword.checkyourmail'); 
            }
            else{
                return view('resetpassword.emailnotfound');
            }
           
        
    }
    public function resetpassword(Request $request){
        $email = $request->email;
        return view('resetpassword.password-reset',compact('email'));
    }
    public function resetpasswordupdate(Request $request){
        $email = $request->useremail;
        // $check_token = DB::table('password_resets')->where([
        //     'email' => $email,
        //     'token' => $token,
        // ])->first();
            $fields = $request->validate([
                'newpassword' => 'required|string',
            ]);
            User::where('email',$email)->update([
                'password' => bcrypt($fields['newpassword']), 
            ]);
            DB::table('password_resets')->where([
                'email' => $email
            ])->delete();
            return view('resetpassword.successfullychanged');
    }
}
