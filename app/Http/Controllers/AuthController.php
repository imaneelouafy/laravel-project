<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate user using email and password
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication successful, retrieve authenticated user
            $user = auth()->user();

            Session::put('user_type', $user->type_id);

            // Redirection basée sur le type d'utilisateur
            if ($user->type_id === 1) {
                return redirect('/layoutOwner')->with('success', 'Login successful!');
                } elseif ($user->type_id === 0) {
                    return redirect('/layoutAdmin')->with('success', 'Login successful!');
                } else {
                    // Gérer le type d'utilisateur inconnu (optionnel)
                    return response()->json([
                        'message' => 'Invalid user type',
                    ], 401);
            }

        // Authentication failed, return error response
        return response()->json([
            'message' => 'Invalid email or password',
        ], 401);
    }
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