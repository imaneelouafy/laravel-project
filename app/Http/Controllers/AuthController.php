<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
