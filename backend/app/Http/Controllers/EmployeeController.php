<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Exception;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        try {
            return response()->json(Employee::all());
        } catch (Exception $e) {
            return response()->json(['message' => 'Error boss: ' . $e->getMessage()], 500);
        }
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $employees = Employee::where('name', 'LIKE', "%".$query."%")
                            ->orWhere('email', 'LIKE', "%".$query."%")
                            ->orWhere('phone', 'LIKE', "%".$query."%")
                            ->orWhere('address', 'LIKE', "%".$query."%")
                            ->get();
        return response()->json($employees);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $employee = Employee::create($validatedData);
        return response()->json($employee);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        if (is_null($employee)) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'string',
            'email' => 'string',
            'phone' => 'string',
            'address' => 'string',
        ]);

        $employee->update ($validatedData);
        return response()->json([
            'message' => 'Updated successfully',
            'employee' => $employee
        ]);
    }

    public function destroy($id)
    {
        try {
            $employee = Employee::find($id);
            if (is_null($employee)) {
                return response()->json(['message' => 'Not found'], 404);
            }
            $employee->delete();
            return response()->json(['message' => 'Employee deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    // public function login(Request $request)
    // {
    //     $employee = Employee::where('email', $request->email)->first();
    //     if($employee){
    //         $token = $employee->createToken('token')->plainTextToken;
    //         return response()->json([
    //             'message' => 'Login successful',
    //             'token' => $token,
    //             'employee' => $employee
    //         ]);
    //     }else{
    //         return response()->json([
    //             'message' => 'Login failed'
    //         ]);
    //     }
    // }

    // public function login(Request $request)
    // {
    //     $employee = Employee::where('email', $request->email)->first();
    //     if($employee){
    //         $token = $employee->createToken('token')->plainTextToken;
    //         return response()->json([
    //             'message' => 'Login successful',
    //             'token' => $token,
    //             'employee' => $employee
    //         ]);
    //     }else{
    //         return response()->json([
    //             'message' => 'Login failed'
    //         ]);
    //     }
    // }
}
