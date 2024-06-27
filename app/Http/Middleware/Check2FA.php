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
            if ($request->segment(1) == 'admin')
                return redirect()->route('super_admin.login.form');
            elseif ($request->segment(1) == 'employee')
                return redirect()->route('employee');
            elseif ($request->segment(1) == 'company')
                return redirect()->route('signin');
            else
                return errorMessage('null', 'verify_otp');
        }
        return $next($request);
    }
}
