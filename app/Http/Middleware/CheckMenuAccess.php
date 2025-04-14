<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckMenuAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $menuSlug = null): Response
    {
        if (!checkMenuAccess($menuSlug)) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'message' => 'Company does not have permission for location tracking',
                ], Response::HTTP_FORBIDDEN)
            );
        }
        
        return $next($request);
    }
}
