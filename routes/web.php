<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

//controller
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PanelisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventAdminController;

//default breeze
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// -- multi auth roles --

// -> user
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified', 'user'])->name('dashboard');

// -> admin
Route::middleware('auth','verified','admin')->group(function () {
    Route::get('/superadmin', [AdminController::class, 'index'])->name('admin');
});

// -> eventadmin atau petugas
Route::middleware('auth','verified','eventadmin')->group(function () {
    Route::get('/eventadmin', [EventAdminController::class, 'index'])->name('eventadmin');
});

// -> panelis atau juri
Route::middleware('auth','verified','panelis')->group(function () {
    Route::get('/panelis', [PanelisController::class, 'index'])->name('panelis');
});

// -- landing page --
Route::get('/kontak', function() {
    return inertia::render('LandingPage/Kontak');
});
Route::get('/informasiberita', function() {
    return inertia::render('LandingPage/InformasiBerita');
});

// -- masih dalam progress --

// Route::middleware('auth','verified','user')->group(function () {
//     Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
// });

// Route::get('/superadmin', function () {
//     return Inertia::render('Roles/Admin/Admin');
// })->middleware(['auth', 'verified', 'admin'])->name('admin');
