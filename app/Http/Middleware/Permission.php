<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$permissions)
    {
        $permissions_array = explode('|', $permissions);
    // $user = $this->auth->user();
    //    dd($permissions_array);
            if($request->user()->hasAccess($permissions_array)){
                return $next($request);
                // dd(true);
            }
            dd("không có quyền này");
            // return redirect()->back();
    }
}
