<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guardian;

class GuardianController extends Controller
{
    // Display a listing of guardians (READ all)
    public function index()
    {
        return response()->json(Guardian::all());
    }

    // Store a newly created guardian (CREATE)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:guardians,email',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'student_id' => 'nullable|string|max:50',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile')) {
            $imagePath = $request->file('profile')->store('photos', 'public');
            $validatedData['profile'] = $imagePath;
        }

        Guardian::create($validatedData);

        return response()->json(['message' => 'Parent added successfully!'], 201);
    }

    // Display a specific guardian (READ one)
    public function show($id)
    {
        $guardian = Guardian::findOrFail($id);
        return response()->json($guardian);
    }

    // Update a specific guardian (UPDATE)
    public function update(Request $request, $id)
    {
        $guardian = Guardian::findOrFail($id);

        $validated = $request->validate([
            'full_name' => 'sometimes|required|string|max:255',
            'email'     => 'sometimes|required|email|unique:guardians,email,' . $guardian->id,
            'phone'     => 'sometimes|required|string|max:20',
            'address'   => 'sometimes|required|string|max:255',
        ]);

        $guardian->update($validated);
        return response()->json($guardian);
    }

    // Delete a specific guardian (DELETE)
    public function destroy($id)
    {
        $guardian = Guardian::findOrFail($id);
        $guardian->delete();

        return response()->json(['message' => 'Guardian deleted successfully']);
    }
}
