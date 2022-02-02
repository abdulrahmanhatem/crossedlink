<?php

namespace App\Http\Middleware;

use Closure;

class RequireRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {

        abort_unless(auth()->check() && auth()->user()->rank == $role, 403 , "You Don't Have Permission To Access This Area");
        return $next($request);
    }

}
