<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class company
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
        //check if user loggedin or not and check user role is commpany 
        if(Auth::check() && Auth::user()->isRole()=='company')
        {
            //if user really comapny then redirect to their home page
             return $next($request);
        }
        return redirect('login');
       
    }
}
