@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            
        </div>
        <div class="col-md-10 ">
            <div class="panel panel-default">
                <div class="panel-heading"><h3><b> My Friends List</b></h3></div>

                <div class="panel-body">
                  <!-- display message for confirm user -->
                     @if(session()->has('msg'))
                        <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×</button>
                              {{session()->get('msg')}}
                            </div>
                      @endif
                 <!-- display message for unfriend user -->
                       @if(session()->has('unfriend'))
                            <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        ×</button>
                                  {{session()->get('unfriend')}}
                                </div>
                       @endif

                    <div class="col-md-12 col-lg-12 col-sm-12">
                   
                       <hr>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12">
                            @foreach($friends as $uList)

                                <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                                    <div class="col-md-2 pull-left">
                                        <img src="{{url('../')}}/images/{{$uList->image}}"
                                        width="80px" height="80px" class="img-rounded accetped_img"/>
                                    </div>

                                    <div class="col-md-7 pull-left accepted_user">
                                        <h3 style="margin:0px;"><a href="{{url('/profile')}}/{{$uList->slug}}">
                                          {{ucwords($uList->name)}}</a></h3>
                                        <p>{{$uList->email}} </p>
                                    </div>

                                    <div class="col-md-3 pull-right">
                                                 <p>
                                                      <a href="{{url('unfriend')}}/{{$uList->id}}" class="btn btn-warning" style="margin-top: 30px;">Unfriend</a>
                                                </p>
                                    </div>

                                </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1">
            
        </div>
    </div>
</div>
@endsection

