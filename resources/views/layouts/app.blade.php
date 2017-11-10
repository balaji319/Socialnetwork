<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/comman.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('posts') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if(Auth::check())
                        <li><a href="{{ url('profile') }}/{{ Auth::user()->slug }}">Profile</a></li>
                        <li><a href="{{ url('/find/friends') }}">Find Friends</a></li>
                        <li><a href="{{ url('friend/requestes') }}"> Friend Request (
                          {{App\Friendship::where('status',0)->where('user_requested',Auth::user()->id)->count()}}
                            )</a></li>
                       <li><a href="{{ url('friends') }}">My Friends</a></li>
                        @endif
                       

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                         <li class="dropdown">
                                <a href="{{ url('friends') }}">
                                   <i class="fa fa-users fa-2x" aria-hidden="true"  style="color: black;"></i>
                                </a>
                            </li>

                             <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                                    <i class="fa fa-globe fa-2x" aria-hidden="true" style="color: black;"></i> 
                                    <span class="badge badge_content">
                                        {{ DB::table('notifications')->where('status',1)
                                                                     ->where('user_hero',Auth::user()->id)
                                                                     ->count()
                                            }}
                                    </span>
                                </a>
                                <?php 
                                   $notes = DB::table('notifications as n')->leftjoin('users as u','u.id','n.user_logged')
                                                                           ->where('user_hero',Auth::user()->id)
                                                                           //->where('status',1)
                                                                           ->orderBy('n.created_at','desc')
                                                                           ->get();
                                 ?>

                                <ul class="dropdown-menu">
                                    @foreach($notes as $note)
                                        @if($note->status == 1)
                                            <li style="background-color:darkgrey"> <a href="{{url('notifications')}}/{{$note->id}}">                                                 
                                         @else
                                              <li> 
                                         @endif 
                                                <a href="{{url('notifications')}}/{{$note->id}}">
                                                  <img src="{{url('../')}}/images/{{$note->image}}"  height="50px" width="50px" class="img-rounded ">
                                                   <b style="color:green; margin-left: 13px;">{{ucwords($note->name)}}</b><small><span style="argin-left: 8px;">{{$note->note}}</span></small>
                                                    <small><i class="fa fa-users" aria-hidden="true"  style="color: black;"></i></small>
                                               </a>
                                                    <hr class="border_line">
                                            </li>
                                          
                                    @endforeach
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                   <img src="{{url('../')}}/images/{{Auth::user()->image}}"  height="35px" width="35px" class="img-circle ">  {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li><a href="{{ route('editprofile') }}">Edit Profile</a></li>
                                </ul>
                            </li>
                              
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
