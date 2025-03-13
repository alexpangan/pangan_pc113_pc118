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

    // public function login(Request $request)
    // {
    //     try {
    //         if (Auth::attempt([
    //             'email' => $request->email,
    //             'password' => $request->password,
    //         ])) {
    //             $user = Auth::user();
    //             $token = $user->createToken('auth_token')->plainTextToken;
    //             return response()->json([
    //                 'message' => 'Login successful',
    //                 'token' => $token,
    //             ], 200);
    //         }

    //         return response()->json([
    //             'message' => 'Invalid email or password',
    //         ], 401);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'error' => 'Login failed',
    //             'message' => $e->getMessage()
    //         ], 500);
    //     }
    // }
}
