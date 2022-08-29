<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SphereClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $inspection = Gate::inspect('sphere-client');

        if( $inspection->allowed() ) {
            return $next($request);
        }
        else
        {
            return response()->json(['message' => 'Non è un account di Sphere'] , 401);
        }                                                      
    }
}
//3|RBeBzsRHxj6DubsuJU2b3XK0HxjB2pls7Tt8IvGG
//5|76EjwxrNXH4uqwu4r3O1sDE5SL0DtvDanGFFcrB3