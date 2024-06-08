<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login using Laravel's built-in authentication
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // User authenticated successfully
            return response()->json([
                'message' => 'Login successful',
                'token' => $request->user()->createToken('access_token')->plainTextToken,
            ]);
        }

        // Login failed
        return response()->json([
            'message' => 'Invalid email or password',
        ], 401);
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users', // Unique email validation
            'password' => 'required|string|min:8|confirmed', // Password confirmation
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password before storing
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'token' => $user->createToken('access_token')->plainTextToken,
        ]);
    }

}
