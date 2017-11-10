<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PostController extends Controller
{
   public function index()
   {
   	  $posts = DB::table('posts as p')->leftjoin('users as u','u.id','p.user_id')
                                       ->leftjoin('profiles as pr','pr.user_id','p.user_id')
   	                                      ->get();
      return view('welcome',compact('posts'));
   }
}
