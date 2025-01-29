<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkMenuAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        $user = auth()->user();
        
        $menuId = $request->route('menu_id');
        $hasPermission = $user->roles()->whereHas('menus', function ($query) use ($menuId, $permissions) {
            $query->where('menu_id', $menuId);
            
            foreach ($permissions as $permission) {
                $query->orWhere("can_{$permission}", true);
            }
        })->exists();

        if (!$hasPermission) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
