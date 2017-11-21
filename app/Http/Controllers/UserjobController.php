<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserjobController extends Controller
{
    public function jobs()
    {
       $jobs = DB::table('users')->Join('companies','users.id','companies.company_id')->get();
       return view('userjob.jobs', compact('jobs'));
    }

      public function job($id)
    {
    	 $jobs = DB::table('users as u')->leftJoin('companies as c','u.id','c.company_id')
							            ->where('c.id',$id)
							            ->get();
         return view('userjob.job', compact('jobs'));
    }
}
