<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use DB;
use Auth;
class FriendshipController extends Controller
{
    public function findfriends()
    {
        $allusers = DB::table('profiles as p')->leftjoin('users as u','u.id','=','p.user_id')
                                              ->where('u.id','!=',Auth::user()->id)
                                              ->get();
        return view('profile.findfriends',compact('allusers'));
    }

    public function sendrequest($id)
    {
      Auth::user()->addfriend($id);
      return back();
    }

    /* Display Friend Request List To Auth User */
    public function requestes()
    {
    	$uid = Auth::user()->id;
    	$friendrequest = DB::table('friendships as f')
        	                ->rightjoin('users as u','u.id','=','f.requester')
        	                ->where('status',0)
        	                ->where('f.user_requested',$uid)->get();
        return view('profile.requestes',compact('friendrequest'));         
    }


    public function confirmrequest($name , $id)
    {
    	$uid = Auth::user()->id;
    	$acceptrequest = DB::table('friendships')
  			    	            ->where('requester',$id)
  			    	            ->where('user_requested',$uid)
  			    	            ->first();
			  if($acceptrequest)
			  {
			  	 $success = DB::table('friendships')
  					  	         ->where('user_requested',$uid)
  					  	         ->where('requester',$id)
  					  	         ->update(['status' => 1]);

          $notification = new Notification;
          $notification->user_hero = $id;
          $notification->user_logged = Auth::user()->id;
          $notification->note ='Accepted Your Friend Request';
          $notification->status = '1';
          $notification->save();

					if($success)
					{
						session()->flash('success',Auth::user()->name . '  You Are Now Friend With  '. $name);
						return back();
					}						  	         			  	         
			   }  	            
			   else
			   {
			      session()->flash('msg','Worng User');;
			   }       
    }

    /*Display My Confirm Friend List*/
    public function myfriends()
    {
      $uid = Auth::user()->id;
       //display data to requester side user_requested Info
      $friend1 = DB::table('friendships as f')->leftjoin('users as u','u.id','=','f.user_requested')
                                              ->where('status',1)
                                              ->where('requester',$uid)
                                              ->get();

       //display data to user_requested side requester Info          
      $friend2 = DB::table('friendships as f')->leftjoin('users as u','u.id','=','f.requester')
                                              ->where('status',1)
                                              ->where('user_requested',$uid)
                                              ->get();
      // dd($friend2);
        $friends = array_merge($friend1->toArray(),$friend2->toArray());
        return view('friendships.myfriendlist',compact('friends'));
    }


    public function removerequest($id)
    {
       DB::table('friendships')->where('user_requested',Auth::user()->id)
                               ->where('requester',$id)
                               ->delete();
        session()->flash('msg','Request Has been Deleted');                     
        return back();
    }

   public function unfriend($id)
   { 
         $loggeduser = Auth::user()->id;
      DB::table('friendships')->where('requester', $id)
                                   ->where('user_requested',$loggeduser)
                                   ->delete();
      session()->flash('unfriend','you are not friend with this user');
      return back();                               
   }






}
