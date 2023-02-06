<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Electron
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
        if($request->bearerToken() === '7202f2dd-6cea-47a8-8b16-6f48bcb3a4f4' || $request->token === 'Bearer 7202f2dd-6cea-47a8-8b16-6f48bcb3a4f4')  //token da modificare in licenceToken        
        {
            return $next($request);
        }
        //return response()->json('Client non autorizzato' , 403);
        return redirect('/');        
    }
}

//lunedi 6 8-14