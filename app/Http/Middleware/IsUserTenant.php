<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class IsUserTenant
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
        if(!Auth::guest())
        {
            if(Auth::user()->type=='tenant')
                return $next($request);
        }
        return redirect('/login');

    }

}

