<?php

namespace App\Http\Controllers;

use App\Models\SchoolActivity;
use Illuminate\Http\Request;

class SchoolActivityController extends Controller
{
    public function index()
    {
        $activities = SchoolActivity::paginate(20);
        return response()->json($activities);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'who' => 'required|string|max:255',
            'what' => 'required|string|max:255',
            'when' => 'required|date',
            'where' => 'required|string|max:255',
            'why' => 'required|string',
            'organizer' => 'required|string|max:255',
        ]);

        $activity = SchoolActivity::create($validated);

        return response()->json($activity, 201);
    }

    public function update(Request $request, $id)
    {
        $activity = SchoolActivity::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'who' => 'required|string|max:255',
            'what' => 'required|string|max:255',
            'when' => 'required|date',
            'where' => 'required|string|max:255',
            'why' => 'required|string',
            'organizer' => 'required|string|max:255',
        ]);

        $activity->update($validatedData);

        return response()->json([
            'message' => 'Activity updated successfully',
            'activity' => $activity,
        ]);
    }

    public function destroy($id)
    {
        $activity = SchoolActivity::findOrFail($id);
        $activity->delete();

        return response()->json([
            'message' => 'Activity deleted successfully',
        ]);
    }

    public function show($id)
    {
        $activity = SchoolActivity::findOrFail($id);
        return response()->json($activity);
    }
    
}