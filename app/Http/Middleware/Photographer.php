<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Photographer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if($request->user()->tokenCan('role:photographer')) {
            return $next($request);
        }

        abort(401);
       
    }
}
