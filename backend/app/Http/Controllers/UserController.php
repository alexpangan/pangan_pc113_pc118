<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'User Dashboard',
            'user' => Auth::user(),
        ]);
        
         
    }
}
