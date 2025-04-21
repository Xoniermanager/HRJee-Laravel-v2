<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('user_2fa')) {
            $path = $request->path();
            if (str_starts_with($path, 'admin')) {
                return redirect()->route('admin.login');
            } else {
                return redirect()->route('base');
            }
        }
        return $next($request);
    }
}
