@extends('company.master')
<style>
  #job_head{
  color:rgb(6, 99, 52); font-weight:bold;
  }
</style>
@section('content')
<div class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-6">
                    <div class="card">
                         <div class="header">
                             <h3 class="title">Add new Job</h3>
                             <p class="category">sub heading here</p>
                              @if(session()->has('addjob'))
                                  <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×</button>
                                    {{session()->get('addjob')}}
                                  </div>
                              @endif
                         </div>
                         <div class="content">

                         <div class="form-group">
                           <form action="{{ url('company/addjobsubmit') }}" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <label><h4><b>Job Title : </b></h4></label>
                                <input type="text" name="job_title" class="form-control"><br>

                                <label><h4><b>Skills</b></h4></label><br>

                                <span>HTML</span> <input type="checkbox" name="Skills[]" value="HTML">
                                <span>CSS</span> <input type="checkbox" name="Skills[]" value="CSS"> 
                                <span>PHP</span> <input type="checkbox" name="Skills[]" value="PHP"> <br>

                                <label><h4><b>Requirments</b></h4></label><br>
                                <textarea cols="55" rows="8" name="requirments"></textarea><br>
                                
                                <label><h4><b>Company Contact Email :</b></h4></label><br>
                                <input type="email" name="con_email" class="form-control"><br><br>

                                <input type="submit" name="submit" class="btn btn-default" value="add job">
                           </form>
                         </div>

                             <div class="footer">
                                 <div class="legend">

                                 </div>
                                 <hr>
                                 <div class="stats">

                                 </div>
                             </div>
                         </div>
                          </div>
                 </div>

                 <div class="col-md-6">
                     <div class="card">
                         <div class="header">
                           <h4 class="title">Heading here</h4>
                           <p class="category">sub heading here</p>
                         </div>
                         <div class="content">

                             <div class="footer">
                                 <div class="legend">

                                  </div>
                                 <hr>
                                 <div class="stats">

                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>



         </div>
     </div>
     @endsection