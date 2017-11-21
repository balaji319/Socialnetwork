<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Auth;
use Carbon;

class CommentController extends Controller
{
    public function addcomments(Request $request)
    {
    	$id = $request->id;
      $comment = new Comment;
   	  $comment->comment = $request->comment;
   	  $comment->post_id = $id;
      $comment->user_id = Auth::user()->id;
      $comment->created_at = Carbon\Carbon::now();
      $comment->updated_at = Carbon\Carbon::now();
      $comment->save();

       if($comment)
       {
         return  post::with('user','like','comment')->orderBy('created_at','DESC')->take(4)->get();   
       }
    }	

   /* public function comments()
    {
    	$comments = Post::with('user','comment')->get();
    	return view('welcome',compact('comments'));
    }*/
}
