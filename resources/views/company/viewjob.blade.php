@extends('company.master')
<style>
  #job_head{
  color:rgb(6, 99, 52); font-weight:bold;
  }

 .table > .table_heading > tr > th
  {
    font-size: 16px;
  }
</style>
@section('content')
<div class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-6">
                    <div class="card">
                         <div class="header">
                             <h4 class="title">Add new Job</h4>
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
                             <div class="footer">
                                 <div class="legend">
                                    <table class="table">
                                          <thead  class="table_heading">
                                                <tr>
                                                  <th>Sr No</th>
                                                  <th>Job_Title </th>
                                                  <th>Skills</th>
                                                  <th>Contact Email</th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                            @foreach($jobs as $job)
                                                <tr>
                                                  <th scope="row"></th>
                                                  <td>{{$job->job_title}}</td>
                                                  <td>{{$job->skills}}</td>
                                                  <td>{{$job->contact_email}}</td>
                                                </tr> 
                                             @endforeach   
                                          </tbody>
                                        </table>
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