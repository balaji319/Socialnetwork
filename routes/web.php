<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('try',function(){
   $unread1 = DB::table('conversions')->where('user_one',Auth::user()->id)->where('status',1)->count();
   return $unread1;
});

Route::get('/', function () {
    return view('welcome');
});


/*Route::get('/simple', function () {
 $noti = DB::table('notifications')->where('user_hero',Auth::user()->id)
                             ->get();
  dd($noti);
});

//display total count of your accpeted request
Route::get('/count', function () {
     $count = DB::table('notifications')->where('status',1)
                                       ->where('user_hero',Auth::user()->id)
                                       ->count();
     echo $count;
});*/



Route::get('/test', function () {
    return Auth::user()->test();
});

Auth::routes();



Route::group(['middleware' =>'auth'], function () {

   //Profile Routes
   Route::get('/home', 'HomeController@index')->name('home');
   Route::get('profile/{slug}', 'ProfileController@index')->name('profile');
   Route::post('changephoto', 'ProfileController@changephoto');
   Route::get('edit/profile', 'ProfileController@editprofile')->name('editprofile');
   Route::post('updateprofile', 'ProfileController@updateprofile');

   //Friend Routes
   Route::get('/find/friends', 'FriendshipController@findfriends');
   Route::get('addFriend/{id}', 'FriendshipController@sendrequest');
   Route::get('friend/requestes','FriendshipController@requestes');
   Route::get('/confirm/request/{name}/{id}','FriendshipController@confirmrequest');
   Route::get('/remove/request/{id}','FriendshipController@removerequest');
   Route::get('friends','FriendshipController@myfriends');
   Route::get('notifications/{id}','NotificationController@notifications');
   Route::get('unfriend/{id}','FriendshipController@unfriend');

   Route::get('jobs','UserjobController@jobs');
   Route::get('job/{id}','UserjobController@job');

});

  //Post Route
  Route::post('addpost','PostController@addpost');
  Route::get('posts','PostController@index');
  Route::get('posts/display','PostController@posts');
  Route::get('deletepost/{id}','PostController@deletepost');
  Route::get('LikePost/{id}','PostController@LikePost');
  Route::get('likes','PostController@likes');
  Route::get('/','PostController@likesp');

 //Comment Post Route
  Route::post('addcomments','CommentController@addcomments');
  //Route::get('/','CommentController@comments');

  //save img 
  Route::post('saveImg','PostController@saveImg');
  
  //Message Route
  Route::get('messages','MessageController@index');
  Route::get('getmessages','MessageController@getmessages');
  Route::get('getmessages/{id}','MessageController@getmesges');
  Route::post('sendMessage','MessageController@sendMessage');
  Route::get('newMessage','MessageController@newMessage');
  Route::post('sendNewMessage', 'MessageController@sendNewMessage');

  //Fprgot Password
  Route::get('forgetpassword','ResetController@forgetpassword');
  Route::post('setToken','ResetController@setToken');
  Route::get('sendEmailDone/{email}/{verifyToken}','ResetController@sendEmailDone');
  Route::post('set/password','ResetController@setpassword');

  Route::get('logout','Auth\LoginController@logout');

 //create company
  Route::group(['prefix'=>'company','middleware' =>['auth','company']], function () {
        Route::get('/','CompanyController@index');
        Route::get('addjob','CompanyController@addnewjob');
        Route::post('addjobsubmit','CompanyController@addjobsubmit');
        Route::get('jobs','CompanyController@jobviews');
    });
 
  //create role as admin
  Route::group(['prefix'=>'admin','middleware' =>['auth','admin']], function () {
       Route::get('/','AdminController@index');
  });