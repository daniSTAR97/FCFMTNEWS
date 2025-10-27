<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicAnnouncementController;
use App\Http\Controllers\AnnouncementController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home redirects to public announcements
Route::get('/', function () {
    return redirect()->route('public.announcements');
});

// Public announcement page (no login required)
Route::get('/announcements', [PublicAnnouncementController::class, 'index'])->name('public.announcements');
Route::get('/announcements/{id}', [PublicAnnouncementController::class, 'show'])->name('public.announcements.show');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin-Only Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/manage/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/manage/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');

});

require __DIR__.'/auth.php';
