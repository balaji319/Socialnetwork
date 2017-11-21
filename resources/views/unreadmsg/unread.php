<?php

 $unread1 = DB::table('conversions')->where('user_one',Auth::user()->id)->where('status',1)->count();
 
 $unread2 = DB::table('conversions')->where('user_two',Auth::user()->id)->where('status',1)->count();

 $unread = $unread1 + $unread1;
 echo $unread;


?>