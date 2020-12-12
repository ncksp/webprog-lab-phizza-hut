<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SimpleAuthorization
{
    private $GUEST = "GUEST";
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        foreach ($roles as $role) {
            if(strtoupper($role) === $this->GUEST) return $next($request);
            
            if(!Auth::check()) continue;
            
            if(Auth::user()->hasRole($role)) return $next($request);
        }
        return $next(abort(404));
    }
}
