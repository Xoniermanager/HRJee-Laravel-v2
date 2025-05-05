<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (!auth()->check() || (auth()->user()->type != "company" && !auth()->user()->userRole)) {
            return redirect()->route('base'); // redirect to login if not already logged in
        } 
        
        return $next($request); // otherwise continue to request
    }
}
