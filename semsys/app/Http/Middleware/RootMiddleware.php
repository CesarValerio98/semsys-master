<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RootMiddleware
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
        $user=Auth::user();
        if(@$user->role_id == '1'){
            return $next($request);
        }else{
            Auth::logout();
            return redirect('/');
        }
    }
}
