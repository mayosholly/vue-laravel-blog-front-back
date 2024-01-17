<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(Request $request){
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed| min:5',
        ]);

        $user = new User($validated);
        $user->save();
        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'Successfully Created'
        ], 201);
    }

    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required| email',
            'password' => 'required'
        ]);
        $user = User::query()->where('email', $request->email)->first();
        if($user && Hash::check($request->password,  $user->password)){
            $token = $user->createToken($request->ip())->plainTextToken;
            return response()->json([
                'token' => $token,
                'user' => $user,
                'message' => 'Successfully Logged in'
            ]);
        }
        return response()->json([
            'message' => 'Invalid Credentials'
        ], 401);
    }

    public function logout(){
        request()->user()->tokens()->delete();
    }
}
