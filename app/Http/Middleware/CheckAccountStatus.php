<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAccountStatus
{
    public function handle($request, Closure $next)
    {
        $companyDetails = Auth()->user();
        if(!$companyDetails) {
            return redirect()->route('base');
        }
        if ($companyDetails && $companyDetails->status == '0') {
            Auth::logout();
            session()->flush();
            return redirect()->route('base')->with(['error' => 'Your Account is Inactive. Please contact support.']);
        }
        return $next($request);
    }
}
