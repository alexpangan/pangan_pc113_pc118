<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return response()->json([
            'message' => 'User Dashboard',
            'user' => Auth::user(),
        ]);
           
    }

    
}
