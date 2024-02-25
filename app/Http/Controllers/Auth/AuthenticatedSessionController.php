<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Jenssegers\Agent\Agent;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request, LoginResponseContract $loginResponse)
    {
        $request->validate([
            'name' => 'required|string', // Change 'email' to 'name' or 'name'
            'password' => 'required|string',
        ]);

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Initialize the Agent class
            $agent = new Agent();

            // Check if the request is coming from a mobile device
            if ($agent->isMobile()) {
                // Redirect to the mobile landing page
                return redirect()->route('mobile-landing');
            } else {
                // Redirect to the web landing page for PC users
                return redirect()->route('web-landing');
            }
        }

        throw ValidationException::withMessages([
            'name' => __('auth.failed'),
        ]);
    }
}
