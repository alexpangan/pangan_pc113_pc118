<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json(Student::all());
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $students = Student::where('name', 'LIKE', "%".$query."%")
                            ->orWhere('course', 'LIKE', "%".$query."%")
                            ->orWhere('year_level', 'LIKE', "%".$query."%")
                            ->orWhere('email', 'LIKE', "%".$query."%")
                            ->get();
        return response()->json($students);
    }
    
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'course' => 'required',
            'year_level' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $student = Student::create($validatedData);
        return response()->json($student);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if (is_null($student)) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'string',
            'course' => 'string',
            'year_level' => 'string',
            'email' => 'string',
            'password' => 'string',
            'phone' => 'number',
            'address' => 'string',
        ]);

        $student->update ($validatedData);
        return response()->json([
            'message' => 'Student updated successfully',
            'student' => $student
        ]);
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if (is_null($student)) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }

    public function login(Request $request)
    {
        $student = Student::where('email', $request->email)->first();
        if($student){
            $token = $student->createToken('token')->plainTextToken;
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'student' => $student
            ]);
        }else{
            return response()->json([
                'message' => 'Login failed'
            ]);
        }
    }

}
