<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //check if user loggedin or not and check user role is admin 
        if(Auth::check() && Auth::user()->isRole()=='admin')
        {
            //if user really admin then redirect to their home page
             return $next($request);
        }
        return redirect('login');
    }
}
