<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class MessageController extends Controller
{
   public function index()
    {
    	return view('message.msg');
    }

    public function getmessages()
    {
    	/*$alluser = DB::table('users as u')->where('u.id','!=',Auth::user()->id)->get();
        return $alluser;*/
        $alluser1 = DB::table('users as u')->join('conversions as c','u.id','c.user_one')
                                           ->where('c.user_two',Auth::user()->id)
                                           ->get();

          $alluser2 = DB::table('users as u')->join('conversions as c','u.id','c.user_two')
                                             ->where('c.user_one',Auth::user()->id)
                                             ->get();         
             return array_merge($alluser1->toArray(),$alluser2->toArray());                                                       
    }

    public function getmesges($id)
    { 
    	/*$checkcon = DB::table('conversions')->where('user_one',Auth::user()->id)->where('user_two',$id)->get();
    	
         if(count($checkcon) != 0)
         {
         	//fetch mess
         	$msg = DB::table('messages as m')->where('m.conversion_id',$checkcon[0]->id)->get();
         	return $msg;
         }
         else
         {
         	echo "no messages";
         }*/

         $msg = DB::table('messages as m')->join('users as u','u.id','m.user_from')
                                          ->where('m.conversion_id',$id)
                                          ->orderBy('m.created_at','ASC')
                                          ->get();
         	return $msg;
    }


    public function sendMessage(Request $request)
    {
       $conID = $request->conID;
       $msg = $request->msg;

       $fetch_user_To = DB::table('messages')->where('conversion_id',$conID)
                                             ->where('user_to','!=',Auth::user()->id)
                                             ->orderBy('messages.created_at','ASC')
                                             ->get();                               
          $userTo = $fetch_user_To[0]->user_to;

          $sendM = DB::table('messages')->insert([
           'user_to'=>$userTo,
           'user_from' => Auth::user()->id,
           'msg'=>$msg,
           'conversion_id' => $conID,
           'status'=>1,
          ]);
          if($sendM)
          {
                  $msg = DB::table('messages as m')->join('users as u','u.id','m.user_from')
                                                   ->where('m.conversion_id',$conID)->orderBy('m.created_at','ASC')->get();
                  return $msg;
          }                     
    }

     public function newMessage()
     {
        $uid = Auth::user()->id;
        $friends1 = DB::table('friendships')->leftJoin('users', 'users.id', 'friendships.user_requested') // who is not loggedin but send request to
                                            ->where('status', 1)
                                            ->where('requester', $uid) // who is loggedin
                                            ->get();
        $friends2 = DB::table('friendships') ->leftJoin('users', 'users.id', 'friendships.requester')
                                             ->where('status', 1)
                                             ->where('user_requested', $uid)
                                             ->get();
        $friends = array_merge($friends1->toArray(), $friends2->toArray());
        return view('message.newMessage', compact('friends', $friends));
    }



    public function sendNewMessage(Request $request)
    {
        $msg = $request->msg;
        $friend_id = $request->friend_id;
        $myID = Auth::user()->id;

        //check if conversation already started or not
        $checkCon1 = DB::table('conversions')->where('user_one',$myID)
                                               ->where('user_two',$friend_id)->get(); // if loggedin user started conversation

        $checkCon2 = DB::table('conversions')->where('user_two',$myID)
                                               ->where('user_one',$friend_id)->get(); // if loggedin recviced message first

        $allCons = array_merge($checkCon1->toArray(),$checkCon2->toArray());
       // echo $allCons[0]->id;
       

        if(count($allCons)!=0)
        {
            // old conversation
            $conID_old = $allCons[0]->id;
            //insert data into messages table
            $MsgSent = DB::table('messages')->insert([
              'user_from' => $myID,
              'user_to' => $friend_id,
              'msg' => $msg,
              'conversion_id' => $conID_old,
              'status' => 1
            ]);
        }
        else 
        {
            // new conversation
            $conID_new = DB::table('conversions')->insertGetId([
              'user_one' => $myID,
              'user_two' => $friend_id
            ]);
              echo $conID_new;
              $MsgSent = DB::table('messages')->insert([
                'user_from' => $myID,
                'user_to' => $friend_id,
                'msg' => $msg,
                'conversion_id' => $conID_new,
                'status' => 1
              ]);
        }
    }
}
