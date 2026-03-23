<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'role' => ['required', 'string', 'in:admin,staff'],
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Invalid email or password.'
            ])->withInput();
        }

        $user = Auth::user();

        // Check selected role vs database role
        if ($request->role !== $user->role) {
            Auth::logout();

            return back()->withErrors([
                'role' => 'Unauthorized role selected.'
            ])->withInput();
        }

        // Check if user is inactive
        if ($user->status !== 'active') {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Your account is inactive. Please contact the admin.',
            ]);
        }

        $request->session()->regenerate();

        $request->session()->forget('url.intended');

        // Redirect based on role 
        if ($user->role === 'admin') {
            return redirect()->route('admin.home');
        } 
        
        if ($user->role === 'staff') {
            return redirect()->route('staff.dashboard');
        }
        abort (403, 'Unauthorized role.');
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
