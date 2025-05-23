<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Check2FA
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('user_2fa')) {
            $path = $request->path();
            if (str_starts_with($path, 'admin'))
                return redirect()->route('admin.login');
            else
                return redirect()->route('base');
        }
        return $next($request);
    }
}
