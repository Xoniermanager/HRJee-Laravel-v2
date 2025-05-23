<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Session;

// class Authenticate
// {
//     public function handle(Request $request, Closure $next)
//     {
//         if (!Session::has('user_2fa')) {
//             if ($request->is('api/*')) {
//                 return $next($request);
//             }
//             $path = $request->path();
//             if (str_starts_with($path, 'admin')) {
//                 return redirect()->route('admin.login');
//             } else {
//                 return redirect()->route('base');
//             }
//         }
//         return $next($request);
//     }

// }

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('base');
    }
}
