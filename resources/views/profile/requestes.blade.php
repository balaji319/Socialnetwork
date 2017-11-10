@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            
        </div>
        <div class="col-md-10 ">
            <div class="panel panel-default">
                <div class="panel-heading"><h3><b> Finf Friends</b></h3></div>

                <div class="panel-body">
                      <!-- display Accept request msg -->
                     @if(session()->has('success'))
                        <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×</button>
                              {{session()->get('success')}}
                            </div>
                      @endif
                    
                    <!-- display remove request msg -->
                       @if(session()->has('msg'))
                        <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×</button>
                              {{session()->get('msg')}}
                            </div>
                      @endif

                    <div class="col-md-12 col-lg-12 col-sm-12">
                   
                       <hr>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12">
                            @foreach($friendrequest as $uList)
                                <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                                    <div class="col-md-2 pull-left">
                                        <img src="{{url('../')}}/images/{{$uList->image}}"
                                        width="80px" height="80px" class="img-rounded requeste_img"/>
                                    </div>

                                    <div class="col-md-7 pull-left requeste_user">
                                        <h3 style="margin-left:0px;"><a href="{{url('/profile')}}/{{$uList->slug}}">
                                          {{ucwords($uList->name)}}</a></h3>
                                          <p>{{($uList->email)}}</p>                                      
                                    </div>

                                    <div class="col-md-3 pull-right" style="margin-top: 25px;">
                                         <p>
                                            <a href="{{url('/confirm/request')}}/{{$uList->name}}/{{$uList->id}}" class="btn btn-primary">Confirm</a>
                                            <a href="{{url('/remove/request')}}/{{$uList->id}}" class="btn btn-danger">remove</a>
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

