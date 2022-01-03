<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
            try{
                $url = redirect()->intended(RouteServiceProvider::HOME)->getTargetUrl();
                return redirect()->intended(RouteServiceProvider::HOME);
            } catch (\Throwable $e) {
                return redirect(RouteServiceProvider::HOME);
            } catch (\Exception $e) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
