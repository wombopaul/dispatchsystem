<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            if($user->user_type == "manager"){
                return redirect()->route('manager.dashboard');
            }
            elseif($user->user_type == "staff"){
                return redirect()->route('staff.dashboard');
            }
        }
        return $next($request);
        
    }
}
