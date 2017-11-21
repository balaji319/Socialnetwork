<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use Auth;
use DB;
class CompanyController extends Controller
{
   public function index()
   {
   	 return view('company.index');
   }

   public function addnewjob()
   {
   	return view('company.addjob');
   }

   public function addjobsubmit(Request $request)
   {
   	
   	 $skills = $request->Skills;
		$com = new Company;
		$com->job_title = $request->job_title;
		$com->skills =implode(',',$skills);
		$com->requirments =$request->requirments;
		$com->company_id = Auth::user()->id;
		$com->contact_email =  $request->con_email;
		$com->save();
		session()->flash('addjob','successfully added new job');
		return redirect('/company/jobs');
   }

   public function jobviews()
   {
   	 $jobs = DB::table('companies')->where('company_id',Auth::user()->id)->get();
   	 return view('company.viewjob',compact('jobs'));

   }
}
