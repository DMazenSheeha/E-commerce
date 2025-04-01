<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|unique:admins,email',
            'password' => 'required|min:8|string|confirmed'
        ]);
        $user = User::create($validated);
        Auth::login($user);
        return to_route('front.index')->with('success', 'Registered successfully');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $credentials = $request->only('email', 'password');
        if (auth()->guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return to_route('front.index')->with('success', 'Logged in successfully');
        } elseif (auth()->guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return to_route('dashboard')->with('success', 'logged in successfully');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('show.login')->with('success', 'Logged out successfully');
    }
}
