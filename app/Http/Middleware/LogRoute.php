<?php

namespace App\Http\Middleware;

use App\Models\LogActivity;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LogRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $response = $next($request);
        // if (app()->environment('local')) {
        //     $log = [
        //         'URI' => $request->getUri(),
        //         'METHOD' => $request->getMethod(),
        //         'REQUEST_BODY' => $request->all(),
        //         'IP' => $request->ip(),
        //         'response_code' => $response->getStatusCode(),
        //         'response_message' => session('success') ?? session('error'),
        //     ];
        //     \Log::info(json_encode($log));
        // }
        // return $response;

        try {
            $response = $next($request);
            if ($response instanceof RedirectResponse && $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Redirect detected. Check endpoint logic.',
                    'redirect_url' => $response->getTargetUrl(),
                ], 400);
            }
            // Capture request and response details
            $log = [
                'user_id' => Auth()->user()->id ?? NULL,
                'company_id' => Auth()->user()->company_id ?? NULL,
                'user_name' => Auth()->user()->name ?? NULL,
                'user_type' => Auth()->user()->type ?? NULL,
                'url' => $request->getUri(),
                'method' => $request->getMethod(),
                'request_body' => json_encode($request->except(['password', 'password_confirmation'])), // Mask sensitive data
                'ip' => $request->ip(),
                'response_code' => $response->getStatusCode(),
                'response_body' => json_encode($this->getResponseContent($response)),
            ];
            if (app()->environment('local')) {
                // LogActivity::create($log);
            }
            return $response;
        } catch (\Exception $e) {
            Log::error('API Error: ' . $e->getMessage(), [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'IP' => $request->ip(),
                'TRACE' => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * Get the response content safely
     */
    private function getResponseContent($response)
    {
        if ($response instanceof JsonResponse) {
            return $response->getData(true); // Convert JSON response to an array
        }

        if ($response instanceof RedirectResponse) {
            return [
                'redirect' => $response->getTargetUrl(),
                'message' => session('error') ?? session('success') ?? session('message') ?? NULL
            ];
        }
        return method_exists($response, 'getContent') ? $response->getContent() : null;
    }
}
