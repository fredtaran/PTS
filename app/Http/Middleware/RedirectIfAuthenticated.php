<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                $date_now = date("Y-m-d");
                $check_login_now = \App\Models\Login::where("userId", $user->id)->where("login", "like", "%$date_now%")->first();
                if(!$user){
                    return redirect('/login');
                }
                else if(!$check_login_now){
                    return redirect('/login_expire');
                }
            }
        }

        return $next($request);
    }
}
