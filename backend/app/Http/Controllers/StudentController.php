<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Exception;

class StudentController extends Controller
{
    public function index()
    {
        try{
            $students = Student::all();
            return response()->json($students);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error : ' . $e->getMessage()
            ]);  
        }
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $students = Student::where('id', 'LIKE', "%".$query."%")
                            ->orWhere('name', 'LIKE', "%".$query."%")
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
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6',
            'phone' => 'required',
            'address' => 'required',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validatedData['profile_picture'] = $imagePath;
        }

        // Hash password
        $validatedData['password'] = bcrypt($validatedData['password']);

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
            'name' => 'sometimes|string',
            'course' => 'sometimes|string',
            'year_level' => 'sometimes|string',
            'email' => 'sometimes|email|unique:students,email,' . $id,
            'password' => 'sometimes|string|min:6',
            'phone' => 'sometimes|string', // better than numeric
            'address' => 'sometimes|string',
            'profile_picture' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validatedData['profile_picture'] = $imagePath;
        }

        // Hash password if provided
        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $student->update($validatedData);

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
