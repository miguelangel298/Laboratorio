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
    public function handle($request, Closure $next, $currentCargo1 = "", $currentCargo2 = "", $currentCargo3 = "")
    {
        $IdCargo = Auth::user()->IdCargo;
        $request['CurrentCargo'] = $IdCargo;

        if ($currentCargo1 != "") {
          if ($IdCargo == $currentCargo1 || $IdCargo == $currentCargo2 || $IdCargo == $currentCargo3) {
            return $next($request);
          } else {
            return redirect('/');
          }
        }
        return $next($request);
    }
}
