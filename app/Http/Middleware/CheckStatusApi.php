<?php

namespace App\Http\Middleware;

use Closure;
class CheckStatusApi
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
        $user = auth()->user();
        if ($user->status && $user->tv) {
            return $next($request);
        } else {
            return redirect()->route('api.user.authorization');
        }
        
    }
}
