<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckEmployeeStatus
{
    public function handle($request, Closure $next)
    {
        $employeeDetails = Auth::user();
        if ($employeeDetails && $employeeDetails->status == '0') {
            Auth::logout();
            session()->flush();
            return redirect()->route('employee')->with(['error' => 'Your Account is Inactive. Please contact Admin.']);
        }
        return $next($request);
    }
}
