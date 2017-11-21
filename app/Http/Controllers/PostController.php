<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Post;
use App\Like;

class PostController extends Controller
{
   public function index()
   {
   	  /*$posts = DB::table('posts as p')->leftjoin('users as u','u.id','p.user_id')
                                       ->leftjoin('profiles as pr','pr.user_id','p.user_id')
   	                                      ->get();*/
      $posts = post::with('user','like','comment')->orderBy('created_at','DESC')->get();                                
      return view('welcome',compact('posts'));
   }

   public function addpost(Request $request)
   {  
     //$content = $request->content;
      $content = new Post;
   	  $content->content = $request->content;
      $content->user_id = Auth::user()->id;
      $content->status = 0;
      //$content->created_at = \Carbon\Carbon::now()->toDateTimeString();
      //$content->updated_at = \Carbon\Carbon::now()->toDateTimeString();
      $content->save();
   	     /*$createPost = DB::table('posts')->insert(['content' =>$content, 'user_id' => Auth::user()->id,
                                        'status' =>0, 'created_at' =>\Carbon\Carbon::now()->toDateTimeString(), 
                                        'updated_at' =>\Carbon\Carbon::now()->toDateTimeString() ]);
*/
     if($content)
       {
         /* $post_json = DB::table('posts as p')->leftjoin('users as u','u.id','p.user_id')
                                              ->leftjoin('profiles as pr','pr.user_id','p.user_id')
                                              ->orderBy('p.created_at','DESC')->take(4)
                                              ->get();                                
          return $post_json;*/
         return  post::with('user','like','comment')->orderBy('created_at','DESC')->take(4)->get();   
       }
   }

    public function posts()
   {
       /* $post_json = DB::table('posts as p')->leftjoin('users as u','u.id','p.user_id')
                                            ->leftjoin('profiles as pr','pr.user_id','p.user_id')
                                            ->select('p.id as post_id','u.image','u.name','u.gender','u.created_at','p.created_at','p.user_id','p.content','pr.city','pr.country','pr.about')
                                            ->orderBy('p.created_at','DESC')->take(4)
                                            ->get();
        return $post_json*/;
        return  post::with('user','like','comment')->orderBy('created_at','DESC')->take(4)->get();
   }

   public function deletepost($id)
   {
       $delete_post = DB::table('posts')->where('id',$id)->delete();
       if($delete_post)
       {
        /* $post_json = DB::table('posts as p')->leftjoin('users as u','u.id','p.user_id')
                                              ->leftjoin('profiles as pr','pr.user_id','p.user_id')
                                              ->orderBy('p.created_at','DESC')->take(4)
                                              ->get();
          return $post_json;*/
           return  post::with('user','like','comment')->orderBy('created_at','DESC')->take(4)->get();
       }
   }


   public function LikePost($id)
   {
       $like = new Like;
       $like->post_id = $id;
       $like->user_id = Auth::user()->id;
       $like->save();

        if($like)
       {
           return  post::with('user','like','comment')->orderBy('created_at','DESC')->get();
       }
   }

   public function likes()
   {
      return like::all();        
   }

   public function likesp()
  {
     $likes = like::all();
     return view('welcome',compact('likes')); 
  }

  public function saveImg(Request $request)
  {
    $img = $request->get('image');

    //remove extra parts
    $exploded = explode(',', $img);
    //echo $exploded[0]; 

    if(str_contains($exploded[0],'gif')){
      $ext = 'gif';
    }
    else if(str_contains($exploded[0],'png'))
    {
      $ext = 'png';
    }
    else
    {
      $ext = 'jpg';
    }

     $decode = base64_decode($exploded[1]);

    //filename of our image
     $filename = str_random() . "." . $ext;

     //local folder path
     $path = public_path() . "/images/" . $filename;

     //put in folder 
     if(file_put_contents($path, $decode))
     {
          $content = new Post;
          $content->content = $request->content;
          $content->user_id = Auth::user()->id;
          $content->status = 0;
          $content->uploadimage = $filename;
          $content->save();
             if($content)
             {
               return  post::with('user','like','comment')->orderBy('created_at','DESC')->take(4)->get();   
             }
       }

  }
}
