<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;

class GateDefineMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('employee')->check()) {
            $employee = Auth::guard('employee')->user();
            $permissions = Permission::whereHas("roles", function ($query) use ($employee) {
                $query->where("roles.id", $employee->userDetails->role_id);
            })->get();
            foreach ($permissions as $permission) {
                Gate::define($permission->name, fn() => true);
            }
        }
        return $next($request);
    }
}
