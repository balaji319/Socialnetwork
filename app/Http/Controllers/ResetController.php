<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use Hash;
use App\User;
use App\Mail\verifyEmail;
use Illuminate\Support\Str;

class ResetController extends Controller
{
    public function forgetpassword()
    {
    	return view('auth.passwords.email');
    }

    public function setToken(Request $request)
    {
		 
       $email =  $request->email;
       $token =  Str::random(40);

       // $user = DB::table('users as u')->join('password_resets as pr','u.email','pr.email')
        								//->update(['verifyToken'=>$token,'token'=>$token]);
       $user = DB::table('users')->where('email',$email)->update(['verifyToken'=>$token]);
       
       if(isset($user))
       {
	       $user_reset = DB::table('users')->where('email',$email)->get();

		       if(count($user_reset) == 0)
		       {
		       	 echo "wrong email address";
		       }
		       else
		       {
		       	  $thisuser = User::findOrFail($user_reset[0]->id);
		     
		       	  $this->sendMail($thisuser);
		       	  session()->flash('reset','Successfully Send Email For ForgotPassword');
		       	  return back();
		       }
       }
       else
       {
       	 echo "wrong user";
       }
       
    }

    public function sendMail($thisuser)
    {
    	Mail::to($thisuser['email'])->send(new verifyEmail($thisuser));
    }

    public function sendEmailDone($email , $verifyToken)
    {
          $verifyToken = $verifyToken;
            return view('reset.setpassword',compact('verifyToken'));
    }
    public function setpassword(Request $request)
    {
    	 $this->validate($request , [
                'password' =>'required',
            ]);

            $verifytoken = $request->verifyToken;
            $reset_pass = new User;
            $reset_pass->password  = Hash::make($request->password);
            $reset_user_pass = DB::table('users')->where('verifyToken',$verifytoken)
                                           ->update(['password'=>$reset_pass->password ,'verifyToken'=>'']);

            if($reset_user_pass)
            {
                session()->flash('msg',' Password Reset sucessfully');
                return back();
            }

    }
}
