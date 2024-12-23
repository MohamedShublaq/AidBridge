<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if(Auth::guard('web')->check()){
                Auth::guard('web')->logout();
            }
            if(Auth::guard('donor')->check()){
                Auth::guard('donor')->logout();
            }
            if(Auth::guard('admin')->check()){
                Auth::guard('admin')->logout();
            }
            if(Auth::guard('ngo')->check()){
                Auth::guard('ngo')->logout();
            }
            return route('showSelection');
        }
    }
}