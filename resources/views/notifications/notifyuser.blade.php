@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
         @include('layouts.sidebar')
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading"><h3><b></b></h3></div>

                <div class="panel-body">
                     @if(session()->has('msg'))
                        <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×</button>
                              {{session()->get('msg')}}
                            </div>

                      @endif

                    <div class="col-md-12 col-lg-12 col-sm-12">
                   
                       <hr>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12">
                            @foreach($notes as $note)

                                <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                                    <div class="col-md-2 pull-left">
                                        <img src="{{url('../')}}/images/{{$note->image}}"
                                        width="80px" height="80px" class="img-rounded accetped_img"/>
                                    </div>

                                    <div class="col-md-7 pull-left accepted_user">
                                        <h3 style="margin:0px;"><a href="{{url('/profile')}}/{{$note->slug}}">
                                          {{ucwords($note->name)}}</a></h3>
                                          <p>{{$note->note}} </p>
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

