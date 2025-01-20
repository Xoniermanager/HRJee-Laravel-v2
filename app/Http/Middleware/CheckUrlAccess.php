<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CheckUrlAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next): Response
    {
        if (Auth::guard('company')->check()) {
            //$currentUrl = '/' . $request->path();

            $segments = request()->segments();
            $baseSegments = array_slice($segments, 0, 2);
            $currentUrl = '/'.implode('/', $baseSegments);

            if ($currentUrl != '/company/dashboard') {
                $accessReponse = $this->checkMenuDetails($currentUrl, Auth::guard('company')->user()->company_id);
                if ($accessReponse)
                    return $next($request);
                else
                    throw UnauthorizedException::notAcessRoute();
            }
        }
        return $next($request);
    }

    private function checkMenuDetails($currentUrl, $companyId)
    {
        return Menu::whereHas('company', function ($query) use ($companyId) {
            $query->where('id', $companyId);
        })->where('slug', $currentUrl)->exists();
    }
}
