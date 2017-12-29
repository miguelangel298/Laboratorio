<?php

namespace Laboratorio\Http\Middleware;

use Closure;
use Auth;

class HasPermission
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
        $IdCargo = Auth::user()->IdCargo;
        $request['IdCargo'] = $IdCargo;
        return $next($request);
    }
}
