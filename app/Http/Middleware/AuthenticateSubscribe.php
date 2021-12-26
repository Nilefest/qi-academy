<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Auth;

class AuthenticateSubscribe
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
        if (Auth::check())
        {
            if(Auth::user()->checkRole('subscribe')) return $next($request);
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        return redirect()->guest(route('login'));
    }
}
