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
        $allowedOrigins = [
            'http://localhost:8000',
            'http://dinas-perkim.test',
            'http://127.0.0.1:8000',
            'http://localhost',
            'https://dinasperkim.go.id', // Production example
            'https://api.dinasperkim.go.id', // Production API example
        ];

        $origin = $request->headers->get('Origin');

        // In local environment, be more permissive
        if (app()->environment('local')) {
            $response->headers->set('Access-Control-Allow-Origin', '*');
        } elseif (in_array($origin, $allowedOrigins)) {
            $response->headers->set('Access-Control-Allow-Origin', $origin);
        }

        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS, PATCH');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, Accept, X-CSRF-TOKEN');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set('Access-Control-Max-Age', '86400');

        // Handle preflight requests
        if ($request->isMethod('OPTIONS')) {
            return response('', 200)
                ->header('Access-Control-Allow-Origin', app()->environment('local') ? '*' : ($origin ?: '*'))
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS, PATCH')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, Accept, X-CSRF-TOKEN')
                ->header('Access-Control-Allow-Credentials', 'true')
                ->header('Access-Control-Max-Age', '86400');
        }

        return $response;
    }
}
