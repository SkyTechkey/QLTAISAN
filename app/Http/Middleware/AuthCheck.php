<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // handle require login before go to dashboard
        if(!session()->has('LoggedUser') && ($request->path() !='login')){
            return redirect('login')->with('fail','You must be logged in!');
        }

        // don't go to login page if logged in
        if(session()->has('LoggedUser') && ($request->path() == 'login') ){
            return back();
        }

        // handle logout then mustn't go back dashboard
        return $next($request)->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
                              ->header('Pragma','no-cache')
                              ->header('Expires','Sat 01 Jan 1990 00:00:00 GMT');
    }
}
