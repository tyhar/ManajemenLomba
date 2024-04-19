<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//default breeze
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//multi auth roles
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified', 'user'])->name('dashboard');

Route::get('/superadmin', function () {
    return Inertia::render('Roles/Admin/Admin');
})->middleware(['auth', 'verified', 'admin'])->name('admin');

Route::get('/eventadmin', function () {
    return Inertia::render('Roles/EventAdmin/EventAdmin');
})->middleware(['auth', 'verified', 'eventadmin'])->name('eventadmin');

//default breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/kontak', function() {
    return inertia::render('kontak');
});
