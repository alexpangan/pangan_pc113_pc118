<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Employee;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json(Student::all());
    }

    
}
