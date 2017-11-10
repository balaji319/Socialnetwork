<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ProfileController extends Controller
{
    public function index($slug)
    {
        $user_pro = DB::table('users as u')->leftjoin('profiles as p','p.user_id','u.id')
                                           ->where('slug',$slug)->get();
    	return view('profile.index',compact('user_pro'))->with('data',Auth::user()->profile);
    }

    public function changephoto(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $path = 'images';
        $file->move($path , $filename);
        DB::table('users')->where('id',Auth::user()->id)->update(['image'=>$filename]);
        session()->flash('msg','successfully updated image');
        return back();

    }

    public function editprofile()
    {
    	return view('profile.editprofile')->with('data',Auth::user()->profile);
    }

    public function updateprofile(Request $request)
    {
    	$user_id = Auth::user()->id;

    	DB::table('profiles')->where('user_id',$user_id)->update($request->except('_token'));
    	session()->flash('msg','successfully updated Info');
        return back();
    }


   
}
