<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    // Show all announcements (for admin dashboard)
    public function index()
    {
        $announcements = Announcement::with('category', 'user')->latest()->get();
        return view('announcements.index', compact('announcements'));
    }

    // Show form to create new announcement
    public function create()
    {
        $categories = Category::all();
        return view('announcements.create', compact('categories'));
    }

    // Save a new announcement
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category_id' => 'nullable|exists:categories,id',
    ]);

    \App\Models\Announcement::create([
        'title' => $request->title,
        'content' => $request->content,
        'category_id' => $request->category_id,
         'user_id' => Auth::id(),
    ]);

    return redirect()->route('announcements.create')->with('success', 'Announcement created successfully!');
    }
    // Show form to edit
    public function edit(Announcement $announcement)
    {
        $categories = Category::all();
        return view('announcements.edit', compact('announcement', 'categories'));
    }

    // Update existing
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $announcement->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('announcements.index')->with('success', 'Announcement updated.');
    }

    // Delete
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('announcements.index')->with('success', 'Announcement deleted.');
    }
}
