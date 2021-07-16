<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Manager
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
        if(!empty(Auth::user())) {
            if (Auth::user()->user_type == "manager") {
                return $next($request);
            } else {
                $notify[] = ['error', 'Staff not allowed to access this page'];
                return redirect()->route('home')->withNotify($notify);
            }
        }else {
            $notify[] = ['error', 'Staff not allowed to access this page'];
            return redirect()->route('home')->withNotify($notify);
        }
    }
}
