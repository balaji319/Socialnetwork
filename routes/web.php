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

   Route::get('/home', 'HomeController@index')->name('home');
   Route::get('profile/{slug}', 'ProfileController@index')->name('profile');
   Route::post('changephoto', 'ProfileController@changephoto');
   Route::get('edit/profile', 'ProfileController@editprofile')->name('editprofile');
   Route::post('updateprofile', 'ProfileController@updateprofile');

   Route::get('/find/friends', 'FriendshipController@findfriends');
   Route::get('addFriend/{id}', 'FriendshipController@sendrequest');
   Route::get('friend/requestes','FriendshipController@requestes');
   Route::get('/confirm/request/{name}/{id}','FriendshipController@confirmrequest');
   Route::get('/remove/request/{id}','FriendshipController@removerequest');
   Route::get('friends','FriendshipController@myfriends');
   Route::get('notifications/{id}','NotificationController@notifications');
   Route::get('unfriend/{id}','FriendshipController@unfriend');

});

 Route::get('posts','PostController@index');


Route::get('logout','Auth\LoginController@logout');