<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            "name" => "required|string|max:191",
            "email" => "required|string|email|max:191|unique:users",
            "password" => "required|string|min:8",
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "access_token" => $token,
            "token_type" => "Bearer",
        ],201); 
    }

    public function login(Request $request){
        $request->validate([
            "email" => "required|string|email",
            "password" => "required|string",
        ]);         

        $user = User::where("email", $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                "email" => ["The provided credentials are incorrect."],
            ]);
        }

        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "access_token" => $token,
            "token_type" => "Bearer",
        ],201); 
    }   

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(["message" => "Logged out successfully."]);
    }
}
