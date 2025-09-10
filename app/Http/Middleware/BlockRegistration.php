<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockRegistration
{
    /**
     * Handle an incoming request.
     *
     * Blocks access to registration endpoints for security purposes.
     * Only existing admin users can create new users through admin panel.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Block registration access with a 404 response (appears as if route doesn't exist)
        abort(404, 'Page not found');

        // Alternative options (uncomment one if needed):
        // return redirect()->route('login')->with('error', 'Registrasi ditutup. Hubungi administrator untuk akun baru.');
        // abort(403, 'Registrasi tidak diizinkan. Silakan hubungi administrator.');
        // return response()->view('errors.registration-disabled', [], 403);
    }
}
