<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompletePersonalInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $civ = Auth::guard('web')->user();
        if (is_null($civ->email) || is_null($civ->id_photo)){
            return redirect()->route('civilian.showProfile')->with('warning','You must complete your personal information.');
        }
        return $next($request);
    }
}