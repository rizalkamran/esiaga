<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
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

            return redirect()->route('web-landing'); // Replace 'index' with your desired route
        }

        throw ValidationException::withMessages([
            'name' => __('auth.failed'),
        ]);
    }
}
