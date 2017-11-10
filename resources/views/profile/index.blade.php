@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$user_pro[0]->name}}</div>

                <div class="panel-body">
                    @if(session()->has('msg'))
                        <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×</button>
                              {{session()->get('msg')}}
                            </div>

                      @endif
 
                   <div class="row" style="border: 1px solid darkgray;">
                      <div class="col-md-5">
                         <div class="panel panel-default user_profile">
                             <div class="panel-headding">
                              
                             </div>
                             <div class="panel-body">
                               <h3 class="user_name"><b>{{ucwords($user_pro[0]->name)}}</b></h3>

                                 <img src="{{url('../')}}/images/{{$user_pro[0]->image}}" height="150px" width="200px" class="img-circle" style="margin-left: 14px;"><br>   
                                 
                                  @if($user_pro[0]->user_id == Auth::user()->id) 
                                     <button class="btn btn-primary change" style="margin-left:57px;margin-top:20px">Change Profile</button>
                                        <form action="{{url('changephoto')}}" method="post" class="form-horizontal user_form" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}" >
                                            <input type="file"  name="file" class="upload" style="display:none">
                                              <button type="submit"  class="btn btn-primary upload" style="display:none">Upload Profile</button>
                                        </form>
                                  @endif  
                             </div>
                         </div>
                      </div>
                      <div class="col-md-7">
                           <button class="btn btn-info btn-sm" style="margin-top: 11px;">About</button>
                           <p>{{$user_pro[0]->about}}</p>
                      </div>
                     
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

 <script src="{{ asset('js/app.js') }}"></script>
 <script src="{{ asset('js/profile.js') }}"></script>
