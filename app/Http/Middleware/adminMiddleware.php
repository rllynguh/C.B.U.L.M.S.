<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class adminMiddleware
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
        if(!Auth::guest()){
            if(Auth::user()->type == 'admin')
                return $next($request);
        }
        return redirect('/login');
    }
}
