<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all();
        return response()->json($announcements);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'who' => 'required|string|max:255',
            'what' => 'required|string|max:255',
            'when' => 'required|date',
            'where' => 'required|string|max:255',
            'why' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
        ]);

        $announcement = Announcement::create($validatedData);
        return response()->json($announcement, 201);
    }

    public function show($id)
    {
        $announcement = Announcement::find($id);

        if (!$announcement) {
            return response()->json(['message' => 'Announcement not found'], 404);
        }

        return response()->json($announcement);
    }

    public function update(Request $request, $id)
    {
        $announcement = Announcement::find($id);

        if (!$announcement) {
            return response()->json(['message' => 'Announcement not found'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'body' => 'sometimes|required|string',
        ]);

        $announcement->update($validatedData);
        return response()->json($announcement);
    }

    public function destroy($id)
    {
        $announcement = Announcement::find($id);

        if (!$announcement) {
            return response()->json(['message' => 'Announcement not found'], 404);
        }

        $announcement->delete();
        return response()->json(['message' => 'Announcement deleted successfully']);
    }
}