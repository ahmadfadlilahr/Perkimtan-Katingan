<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\ActivityLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        // Don't auto-redirect - let user access login page to logout properly
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Manual validation instead of using LoginRequest
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Manual authentication attempt
        if (!\Illuminate\Support\Facades\Auth::attempt(
            $request->only('email', 'password'),
            $request->boolean('remember')
        )) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        $request->session()->regenerate();

        // Force session save to ensure persistence
        $request->session()->save();

        // Log the login activity
        ActivityLog::createLog('login');

        return to_route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log the logout activity before logging out
        ActivityLog::createLog('logout');

        // Logout the user
        Auth::guard('web')->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Force save session changes
        $request->session()->save();

        return redirect('/login')->with('status', 'Successfully logged out');
    }
}
