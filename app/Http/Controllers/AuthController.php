<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user){
            $token = $user->createToken('token')->plainTextToken;
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user
            ]);
        }else{
            return response()->json([
                'message' => 'Login failed'
            ]);
        }
    }
}
