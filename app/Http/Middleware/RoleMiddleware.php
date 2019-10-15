<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role_id,$team_id)
    {
        if (auth()->user()->role_id == $role_id and auth()->user()->team_id == $team_id)
            return $next($request);
        return abort(401);
    }
}
