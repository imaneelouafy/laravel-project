<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return response()->json([
                'message' => 'Invalid email or password',
            ], 401);
        }
    
        // If user exists, check the password
        if (Hash::check($request->password, $user->password)) {
            // Password matches, log in the user
            Auth::login($user);
            return Redirect::to('/layoutAdmin')->with('success', 'Inscription réussie! Vous pouvez maintenant vous connecter.');
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
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Rediriger vers la page de connexion
        return Redirect::to('/login')->with('success', 'Inscription réussie! Vous pouvez maintenant vous connecter.');
    }

    public function signOut(Request $request)
    {
        $request->user()->tokens()->delete(); // Revoke all tokens for the user
        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

}