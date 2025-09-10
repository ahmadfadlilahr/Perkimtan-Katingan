<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Get allowed origins
        $allowedOrigins = array_filter([
            // Development domains
            'http://localhost:8000',
            'http://dinas-perkim.test',
            'http://127.0.0.1:8000',
            'http://localhost',
            'http://localhost:3000', // React/Vue development

            // Production domains (set via environment variables)
            env('CORS_ALLOWED_ORIGIN_1'),
            env('CORS_ALLOWED_ORIGIN_2'),
            // Add more production domains as needed
        ]);

        $origin = $request->headers->get('Origin');

        // Handle CORS origin properly (never use * with credentials)
        if ($origin && in_array($origin, $allowedOrigins)) {
            $response->headers->set('Access-Control-Allow-Origin', $origin);
        } elseif (app()->environment('local') && $origin) {
            // In local environment, allow the specific origin (not wildcard)
            $response->headers->set('Access-Control-Allow-Origin', $origin);
        } elseif (app()->environment('local') && !$origin) {
            // For same-origin requests without Origin header, don't set CORS headers
            // This prevents conflicts with credentials
            return $response;
        }

        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS, PATCH');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, Accept, X-CSRF-TOKEN');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set('Access-Control-Max-Age', '86400');

        // Handle preflight requests
        if ($request->isMethod('OPTIONS')) {
            $responseOrigin = null;

            if ($origin && in_array($origin, $allowedOrigins)) {
                $responseOrigin = $origin;
            } elseif (app()->environment('local') && $origin) {
                $responseOrigin = $origin;
            }

            $optionsResponse = response('', 200)
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS, PATCH')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, Accept, X-CSRF-TOKEN')
                ->header('Access-Control-Max-Age', '86400');

            if ($responseOrigin) {
                $optionsResponse->header('Access-Control-Allow-Origin', $responseOrigin);
                $optionsResponse->header('Access-Control-Allow-Credentials', 'true');
            }

            return $optionsResponse;
        }

        return $response;
    }
}
