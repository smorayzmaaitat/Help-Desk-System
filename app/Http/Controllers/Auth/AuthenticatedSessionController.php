<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
    */
    
    public function store(LoginRequest $request): RedirectResponse
    {
        // Step 1: Retrieve the input data
        $email = $request->input('email');
        $password = $request->input('password');
        $role = $request->input('role'); // Assuming the role is also sent in the login form
        // Step 2: Check for a user with the given email and role
        $user = User::where('email', $email)->where('role', $role)->first();
    
        // Step 3: If user with email and role exists, attempt to authenticate
        if ($user && Auth::attempt(['email' => $email, 'password' => $password])) {
            // Regenerate session for security after successful login
            $request->session()->regenerate();
    
            return redirect()->intended(route('dashboard', absolute: false));
        }
    
        // If the user with the specified role wasn't found or authentication failed
        return redirect()->route('login')->withErrors([
            'email' => 'The provided credentials do not match our records or your role does not have access.',
        ]);
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
