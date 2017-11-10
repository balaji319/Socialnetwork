<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

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
           .post_img
           {
                height: 107px;
                width: 10%;
                margin-top: 32px;
                margin-left: 40px;
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
           
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Dashboard</a>
                       <!--  <a href="{{ url('profile') }}/{{Auth::user()->slug}}">Profile</a> -->
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

           <!-- -->

           <div class="">
            @if (Auth::check() && Auth::user()->id)
                 <div class="row post_user">
                    @foreach($posts as $post)
                       <div class="col-md-12 " >
                             <div class="col-md-2 pull-left">
                               <img src="{{url('../')}}/images/{{$post->image}}"    alt="" title="" class="img-rounded post_img">
                            </div>
                            <div class="col-md-10" style="margin-left: 66px;">
                                <h3>{{$post->name}}</h3>
                                <p style="color: darkgreen;"><b>{{$post->content}}</b></p>
                            </div>
                       </div>
                    @endforeach  
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
    </body>
</html>
