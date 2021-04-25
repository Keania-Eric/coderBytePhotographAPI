<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProductOwner
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
        if($request->user()->tokenCan('role:productowner')) {
            return $next($request);
        }

        abort(401);
    }
}
