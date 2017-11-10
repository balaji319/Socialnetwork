<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class NotificationController extends Controller
{
    public function notifications($id)
    {
    	
    	 $notes = DB::table('notifications as n')->leftjoin('users as u','u.id','n.user_logged')
    	                                         ->where('n.user_logged',$id)
                                               ->where('user_hero',Auth::user()->id)
                                               ->orderBy('n.created_at','desc')
                                               ->get();
       $updatenoti = DB::table('notifications as n')
                               ->where('n.user_logged',$id)
                               ->update(['status'=>0]);

       return view('notifications.notifyuser',compact('notes'));                         
    }
}
