<?php

namespace App\Http\Middleware;

use Closure;

class checkhost
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

    $hostip = substr($request->server("HTTP_HOST"), 0,strrpos($request->server("HTTP_HOST"), ":"));
        if($request->ip() === $hostip || $request->ip() === "127.0.0.1" || $request->ip()==="::1"){
        return $next($request);
        }
        return redirect('/');
            
    }
}
