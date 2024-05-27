<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthorizeDashboardAccess
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('signin'); // Redirect to login page if user is not authenticated
        }
        
        return $next($request);
    }
}
