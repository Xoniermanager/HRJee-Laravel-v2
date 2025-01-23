<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckCompanyStatus
{
    public function handle($request, Closure $next)
    {
        $companyDetails = Auth::guard('company')->user();
        if ($companyDetails && $companyDetails->status == '0') {
            Auth::logout();
            session()->flush();
            return redirect()->route('signin')->with(['error' => 'Your company is Inactive. Please contact support.']);
        }
        return $next($request);
    }
}
