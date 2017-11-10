@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3><b> Find Friends</b></h3></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-md-12 col-lg-12 col-sm-12">
                   
                       <hr>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12">
                            @foreach($allusers as $uList)

                                <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                                    <div class="col-md-2 pull-left">
                                        <img src="{{url('../')}}/images/{{$uList->image}}"
                                        width="80px" height="80px" class="img-rounded"/>
                                    </div>

                                    <div class="col-md-7 pull-left">
                                        <h3 style="margin:0px;"><a href="{{url('/profile')}}/{{$uList->slug}}">
                                          {{ucwords($uList->name)}}</a></h3>
                                        <p> {{$uList->city}}  - {{$uList->country}}</p>
                                        <p>{{$uList->about}}</p>

                                    </div>

                                    <div class="col-md-3 pull-right">
                                        <?php 

                                           $check = DB::table('friendships')
                                                        ->where('user_requested',$uList->id)
                                                        ->where('requester',Auth::user()->id)
                                                        ->first();

                                                if($check == '')
                                                { 

                                              ?>
                                                 <p>
                                                      <a href="{{url('/')}}/addFriend/{{$uList->id}}"
                                                           class="btn btn-primary">Add Friend</a>
                                                </p>
                                              <?php } else { ?>
                                              
                                                    <button class="btn btn-primary">Requeste Alredy Send</button>

                                              <?php } ?>  
                                              
                                    </div>

                                </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
