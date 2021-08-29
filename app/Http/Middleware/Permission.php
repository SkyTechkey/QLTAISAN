<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Permission
{
    public function handle(Request $request, Closure $next,$permissions)
    {
        $permissions_array = explode('|', $permissions);
   
            if($request->user()->hasAccess($permissions_array)){
                return $next($request);
            }
            return redirect()->back();
    }
}
