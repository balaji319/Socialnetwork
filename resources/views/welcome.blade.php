<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/comman.css') }}" rel="stylesheet">
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/moment.min.js"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color:grey;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
     
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
                margin-top: -57px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
           .post_user
           {
                margin-top: 7%;
                margin-left: 5%;
                background-color: whitesmoke;
                width: 78%;
           }
         
         .m-b-md
         {
                text-align: center;
                margin: 18%;
                border-bottom: 1px solid rosybrown;
         }
         .links > a 
         {
                color: wheat;
                padding: 0 25px;
                font-size: 16px;
        }
        .post_nav li a
        {
               color: antiquewhite;
              font-size: 17px;
              margin-right: 20px;
        }
        .post_nav li a:hover
        {
          color: red;
        }   

        .comment_div
        {
          color: blue;
        }
         .comment_div:hover
        {
          cursor: pointer;
        }
        .upload_img
        {
          border: 1px solid burlywood;
           border-radius: 10px;
           background-color: ghostwhite;
           padding: 3 15 3 10;
           margin-bottom: 10px;
           height: 31px;
           width: 114%
        }
        .span_div
        {
           padding-left: 16px;
           padding-top: 4px;
        }
        .remove_img
        {
          top: 0px;
          right: 0px;
          position: absolute;
          cursor: pointer;
        }
        .upload_remove_img
        {
          position: relative;
          display: inline-block;
        }
        .textarea_content
        {
          z-index: auto;
          position: relative;
          line-height: 22.4px;
          font-size: 14px;
          transition: none;
          background: transparen !important;
          background: dimgrey;
          color: white;
          width: 95%;
          margin-bottom: 13px;
        }
        </style>


    </head>
    <body>
         <nav class="navbar navbar-default navbar-static-top" style="height: 58px;">
          <div class="collapse navbar-collapse " id="app-navbar-collapse  ">
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right post_nav">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}"><b>Login</b></a></li>
                            <li><a href="{{ route('register') }}"><b>Register</b></a></li>
                        @else
                            <li class="dropdown">
                                <a href="{{ url('/home') }}" style="font-size: 17px "><b>Dashboard  ( {{Auth::user()->name}} )</b></a>
                            </li>
                            <li class="dropdown">
                                  <a href="{{ route('logout') }}" style="font-size: 17px "><b>Logout</b></a>
                            </li>     
                         @endguest                
                    </ul>
                </div>
              </nav>
<div class="col-md-12"  id="app" style="margin-top: -22px;">
  <div class="col-md-3 left-sidebar hidden-xs hidden-sm  " >
    <h3 align="center">Left Sidebar</h3>
         @include('layouts.welcomsidebar')
  </div>

  <div class="col-md-6 col-sm-12 col-xs-12 center-con">
    @if(Auth::check())
      <div class="posts_div">
         <div class="head_har">
              @{{msg}}
          </div>
          <div style="background-color:#fff">
              <div class="row">
                <div class="col-md-1 pull-left">
                  <img src="{{url('../')}}/images/{{Auth::user()->image}}"
                   style="width:56px; margin:5px; padding:5px" class="img-circle">
                </div>
                <div class="col-md-11 pull-right">
                    <div  v-if="!image">
                        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="addpost">
                            <textarea v-model="content" id="postText" class="form-control textarea_content"
                            placeholder="what's on your mind ?"></textarea>
                            <button type="submit" class="btn btn-sm btn-info pull-right" style="margin:10px" id="postBtn">Post</button>
                        </form>
                    </div>
                  <div v-if="!image" style="position: relative;display: inline-block;">
                     <div class="upload_img">
                       <span class="glyphicon glyphicon-upload span_div" ></span> <b>photo upload</b>
                       <input type="file" @change="onfilechange" style="position:absolute;left: 0;top: 0; opacity: 0" />  
                     </div>          
                  </div>
                  <div v-else>
                    <textarea v-model="content" class="form-control textarea_content"
                            placeholder="what's on your mind ?"></textarea>
                    <div class="upload_remove_img">
                         <img :src="image" style="width:100px"/><br>
                         <b @click="removeImg" class="remove_img">X</b>
                    </div>
                      <button @click="uploadImg" class="btn btn-sm btn-info pull-right" style="margin:10px">Post</button> 
                  </div>
                </div>
              </div>
          </div>
      </div>
      @endif
             <!--<div class="head_har">  Posts</div> -->
              <div class="row">
                   <div class="col-md-10 all_posts" style="margin-left:14px;width:97%">
                        <div class="head_har">
                               <h4> @{{oldpost}}</h4>
                        </div>                  
                     <div v-for="post,key in posts" style="border-bottom: 1px solid gainsboro;">
                            <div class="col-md-12 " style="border-bottom: 1px solid beige;">
                                <div class="col-md-2 pull-left">
                                    <img :src="'{{url('../')}}/images/'+post.user.image" heigth="50px"  alt="" title="" class="img-rounded post_img">
                                </div>
                                <div class="col-md-10" >
                                  <div class="col-md-9 user_post_content">
                                       <h3>@{{post.user.name}}</h3>
                                        <p><b>@{{post.created_at | mytime}}</b></p> 
                                  </div>   
                                  <div class="col-md-3">
                                    <!-- Delete Post By Auth User  Section -->
                                     @if(Auth::check())
                                      <a href="#" data-toggle="dropdown" aria-haspopup="true" class="pull-right">
                                         <img src="{{url('../')}}/images/setting.jpg"  title="Edit Post" class="img-rounded" 
                                               style="height: 16px; margin-top: 18px;">
                                      </a>
                                      <div class="dropdown-menu">
                                         <li><a href="">Some action</a></li>
                                         <li><a href="">some action</a></li>
                                         <div class="dropdown-divider"></div>
                                         <li v-if="post.user_id == '{{Auth::user()->id}}'">
                                           <a @click="deletepost(post.id)">
                                             <i class="fa fa-trash"></i>Delete
                                           </a>
                                         </li>
                                      </div>
                                  </div> 
                                  @endif
                                   <!-- End Delete Post Section   -->                         
                                </div>
                                
                                  <div class="col-md-12"  style="color:#000; margin-top:15px; font-family:inherit">
                                      <p class=" pull-left" >
                                          <b style="font-size: 15px; margin-left: -18px;margin-top: -14px;" >Post : </b>
                                           <b style="color: darkgreen;">
                                                 @{{post.content}}<br>
                                                 <p><img v-if="post.uploadimage" :src="'{{url('../')}}/images/'+post.uploadimage" class="post_upload_img"></p>
                                            </b>
                                       </p>
                                  </div>
                                <div class="col-md-12"  style="padding:10px; border-top:1px solid #ddd">
                                   <div class="col-md-4">                                          
                                      @if(Auth::check())
                                           <!-- liked person   -->
                                           <p v-if="post.like.length!=0" style="color: black; margin-left: -23px; margin-top: -9px;"  
                                                class="likebtn" @click="LikePost(post.id)">
                                                <b style="cursor: pointer;"><span class="glyphicon glyphicon-thumbs-up"> Like</span>
                                                <b style="color: black"> @{{post.like.length}}</b></b>
                                           </p>
                                            <!-- on one liked person   -->
                                           <p v-else  class="likebtn" @click="LikePost(post.id)" style=" margin-left: -23px; margin-top: -9px;">
                                            <b style="color: black">No Likes</b><br>
                                             <b  style="cursor: pointer;color: black"> <span class="glyphicon glyphicon-thumbs-up"> Like</span> 
                                             </b>
                                           </p>                                
                                     @endif            
                                      <!-- End like -->
                                   </div>
                                   <div class="col-md-4">
                                      <p @click="commentSeen=!commentSeen" class="comment_div">
                                         <b>Comment (@{{post.comment.length}})</b>
                                      </p> 
                                       
                                   </div>
                                    <div class="col-md-4">
                                  .......
                                   </div>
                                 </div>
                            </div>  
                           @if(Auth::check())
                              <!-- comment Section -->
                              <div id="commentBox" v-if="commentSeen">
                                  <div class="commet_form">
                                      <!-- send comment-->
                                        <textarea class="form-control " v-model="commentadd[key]" style="color: indigo"></textarea>                  
                                        <button class="btn btn-success" @click="sendcomment(post,key)">Send</button>  
                                  </div>
                                      <ul v-for="comment in post.comment">
                                          <li><b>@{{comment.comment}}</b><b class="pull-right">@{{comment.created_at | mytime}}</b></li>
                                      </ul>
                              </div> 
                              <!-- End comment Section --> 
                           @endif                  
                      </div>        
                    </div>
                </div>        
            </div>
          </div>

  <div class="col-md-3 right-sidebar hidden-sm hidden-xs" >
      <h3 align="center">Right Sidebar</h3>
   </div>

</div>


<script src="{{ asset('js/app.js') }}"></script>
 <script>
    $(document).ready(function(){
    $('#postBtn').hide();
      $("#postText").hover(function() {
      $('#postBtn').show();
     });
    });
</script>



    </body>
</html>
<!-- '{{Config::get('app.url')}}/public/images/' + post.image -->



<!-- 
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Dashboard</a>
                       <a href="{{ url('profile') }}/{{Auth::user()->slug}}">Profile</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

           

           <div class="">

            @if (Auth::check() && Auth::user()->id)
                <div class="row post_user">
                    <div id="app">
                        <button class="btn btn-info post_head">Add Post</button>
                        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="addpost" class="form_post">  
                        {{ csrf_field() }}  
                        <textarea cols="20" rows="3" v-model="content"></textarea>
                        <button class="btn btn-primary" type="submit">Add Post</button>
                        </form>
                        <div v-for="post in posts" >
                            <div class="col-md-12 " >
                                <div class="col-md-2 pull-left">
                                    <img :src="'{{url('../')}}/images/'+post.image"   alt="" title="" class="img-rounded post_img">
                                </div>
                                <div class="col-md-10" >
                                    <h3>@{{post.name}}</h3>
                                    <h4><b>Gneder : </b> @{{post.gender}}</h4>
                                    <p><b>@{{post.created_at}}</b></p>                              
                                </div>
                                <div class="col-md-12"><p style="color: darkgreen;"><b>@{{post.content}}</b></p> </div>
                            </div>
                        </div>  
                    </div>
                </div>
            @else
                <div class="content">
                    <div class="title m-b-md">
                        <img src="{{url('../')}}/images/face.png"  class="img-rounded ">
                    </div>                  
                </div>  
            @endif 
           </div>
        </div>
           <script src="{{ asset('js/app.js') }}"></script> -->