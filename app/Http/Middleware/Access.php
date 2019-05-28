<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$allowed_types)
    {
        if(in_array(Auth::user()->type,$allowed_types)){
           return $next($request);
        }
        
        return redirect('/');
    }
}
