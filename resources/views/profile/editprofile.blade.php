@extends('profile.master')

@section('content')
 <link href="{{ asset('css/profile.css') }}" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-md-1 col-lg-1">
          
        </div>

        <div class="col-md-10 col-lg-10 col-sm-12">
          <!-- <div class="panel panel-default">
                <div class="panel-heading">User Profile</div> -->

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="user-details">
                            <div class="user-image">
                                <img src="{{url('../')}}/images/{{Auth::user()->image}}" height="120px"  alt="Karan Singh Sisodia" title="Karan Singh Sisodia" class="img-circle">
                            </div>
                            <div class="user-info-block">
                              <div class="user-heading">
                                <h3><b>{{Auth::user()->name}}</b></h3>
                                <span class="help-block"><i><b>{{$data->city}} - {{$data->country}}</b></i></span>
                                <div>
                                  <button class="btn btn-primary change">Change Profile</button>
                                  <form action="{{url('changephoto')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}" >
                                    <input type="file"  name="file" class="upload" style="display:none;margin-left: 41%;">
                                    <button type="submit"  class="btn btn-primary upload" style="display:none">Upload Profile</button>
                                  </form>
                                </div>
                              </div>
                                <ul class="navigation">
                                  <li class="active">
                                    <a data-toggle="tab" href="#information">
                                      <span class="glyphicon glyphicon-user"></span>
                                     </a>
                                  </li>   
                                  <li>
                                    <a data-toggle="tab" href="#settings">
                                    <span class="glyphicon glyphicon-cog"></span>
                                    </a>
                                  </li>
                                  <li>
                                    <a data-toggle="tab" href="#email">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                    </a>
                                  </li>
                                  <li>
                                    <a data-toggle="tab" href="#events">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </a>
                                  </li>
                                </ul>
                                <div class="user-body">
                                    <div class="tab-content">
                                      <div id="information" class="tab-pane active">
                                        <!-- Success message for profile data -->
                                         @if(session()->has('msg'))
                                            <div class="alert alert-success">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                        ×</button>
                                                  {{session()->get('msg')}}
                                                </div>
                                          @endif
                                         <h3><b>Personal Information:</b></h3>
                                         <form action="{{url('updateprofile')}}" method="post">
                                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="form-group">
                                              <div class="col-md-6 ">
                                                 <label>City</label>
                                                   <input type="text" name="city" value="{{$data->city}}" placeholder="City" class="form-control">
                                              </div>
                                              <div class="col-md-6 ">
                                                 <label>Country</label>
                                                   <input type="text" name="country" value="{{$data->country}}" placeholder="Country" class="form-control">
                                              </div>                                           
                                            </div>
                                            <div class=" form-group">
                                                 <div class="col-md-6">
                                                    <label>About</label>
                                                     <textarea cols="6" rows="5" name="about" placeholder="About" class="form-control">{{$data->about}}</textarea>
                                                 </div>
                                                 <div class="col-md-6">
                                                  
                                                 </div>
                                            </div> 
                                            <div class="form-group">
                                              <div class="col-md-6 ">
                                                 <button type="submit"  class="btn btn-primary update_pro" >Update</button>
                                              </div>
                                              <div class="col-md-6 ">
                                                
                                              </div>                                           
                                            </div>                                          
                                         </form>
                                      </div>
                                      <div id="settings" class="tab-pane">
                                         <h4>Settings</h4>
                                      </div>
                                      <div id="email" class="tab-pane">
                                         <h4>Send Message</h4>
                                      </div>
                                      <div id="events" class="tab-pane">
                                        <h4>Events</h4>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               <!--  </div>
                           </div> -->
        </div>

        <div class="col-md-1 col-lg-1">
          
        </div>
    </div>
</div>
@endsection
     <script src="{{ asset('js/profile.js') }}"></script>
     <script type="text/javascript">
       $(document).ready(function(){
         $('.change').on('click',function(){
          $('.change').hide();
          $('.upload').show('slide');
         })
       })
     </script>

