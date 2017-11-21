@extends('profile.master')
@section('content')

<div class="container">

    <ol class="breadcrumb">
        <li><a href="{{url('/home')}}">Home</a></li>
        <li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
        <li><a href="">Jobs</a></li>
    </ol>


    <div class="row">
        @include('layouts.sidebar')


        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading"><h4><span style="color:green">{{ucwords(Auth::user()->name)}}</span>, Jobs you may be interested in</h4>Any location Selected industries:  Any industry Selected company size range:  1 to 1,000 employees        
                 </div>

                <div class="panel-body">
                         @if ( session()->has('msg') )
                         <p class="alert alert-success">
                                      {{ session()->get('msg') }}
                                   </p>
                                @endif
                      <div class="row">
                               @foreach($jobs as $job)
                                <div class="col-md-4">
                                    <div class="jobDiv">
                                        <a href="{{url('job')}}/{{$job->id}}">
                                            <img src="{{url('../')}}/images/{{$job->image}}" height="50px" class="img-circle company_pic" style="margin-bottom: 9px; margin-top: 29px;">
                                            <div class="caption remove_style">
                                                <li><i class="fa fa-briefcase" aria-hidden="true"></i> {{$job->job_title}} </li>
                                                <li><i class="fa fa-building-o" aria-hidden="true"></i> {{ucwords($job->name)}}</li>
                                            </div>   
                                        </a>
                                        <li class="remove_style"> <?php $skills = explode(',',$job->skills)?>
                                            @foreach($skills as $skill)
                                                <div style="background-color:#283E4A; color:#fff; margin-top:5px; border-radius:10px; width:100%; float:left; padding:3px 15px 3px 15px">
                                                   {{$skill}}
                                                </div>
                                            @endforeach
                                            <a href="{{url('job')}}/{{$job->id}}" style="margin-top:10px; width:100%" class="btn btn-primary">View details</a>
                                        </li>   
                                    </div>
                                 </div>                             
                            @endforeach                           
                      </div>
                       <hr>
                 </div>
              </div>
           </div>
        </div>
    </div>
</div>


@endsection
