<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // check
        if (Auth::attempt($request->only('email', 'password'))) {
            // user is auth
            $user = Auth::user();
            $token = $user->createToken('admin')->plainTextToken; // Use plainTextToken
            \Log::info("User {$user->email} logged in. Access Token: $token");
    
            return [
                'token' => $token,
                'user' => $user,
            ];
        }
    
        return response([
            'error' => 'invalid credentials'
        ], HttpResponse::HTTP_UNAUTHORIZED);
    }
}
