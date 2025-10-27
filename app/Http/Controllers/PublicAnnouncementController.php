<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicAnnouncementController extends Controller
{
public function index(Request $request)
{
    $query = Announcement::with('category');

    // Filter by category
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // Search filter
    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('content', 'like', '%' . $request->search . '%');
    }

    // Pagination (5 per page)
    $announcements = $query->latest()->paginate(5);

    $categories = Category::all();

    return view('public.announcements.index', compact('announcements', 'categories'));
}
public function show($id)
{
    $announcement = Announcement::with('category')->findOrFail($id);
    return view('public.announcements.show', compact('announcement'));
}
}
