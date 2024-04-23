<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

//controller
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PanelisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventAdminController;
use App\Http\Controllers\UserController;

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
//dont forget to add controller class or any other import needed

// -> user
Route::middleware('auth','verified','user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
});

// -> admin
Route::middleware('auth','verified','admin')->group(function () {
    Route::get('/superadmin', [AdminController::class, 'index'])->name('admin');
    Route::get('/partisipan', [AdminController::class, 'partisipan']);
    // Route::resource('superadmin/partisipan', [PartisipanController::class]);
    Route::get('/pesan', [AdminController::class, 'pesan']);
    // Route::resource('superadmin/pesan', [PesanController::class]);
    Route::get('/lomba', [AdminController::class, 'lomba']);
    Route::get('tambahlomba', [AdminController::class, 'tambahlomba']);
    Route::get('/editlomba', [AdminController::class, 'editlomba']);
    Route::get('/detaillomba', [AdminController::class, 'detaillomba']);
    // Route::resource('superadmin/lomba', [LombaController::class]);
    Route::get('/administrator', [AdminController::class, 'administrator'])->name('administrator');
    Route::get('/tambahadministrator', [AdminController::class, 'tambahadministrator']);
    Route::post('/tambahadministrator', [UsersController::class, 'store'])->name('daftar.store');
    Route::get('/editadministrator', [AdminController::class, 'editadministrator']);
    Route::get('/detailadministrator', [AdminController::class, 'detailadministrator']);
    // Route::resource('superadmin/administrator', [AdministratorController::class]);
    Route::get('/tim', [AdminController::class, 'tim']);
    Route::get('/detailtim', [AdminController::class, 'detailtim']);
    // Route::resource('superadmin/tim', [TimController::class]);
    Route::get('/sponsor', [AdminController::class, 'sponsor']);
    Route::get('/tambahsponsor', [AdminController::class, 'tambahsponsor']);
    Route::get('/editsponsor', [AdminController::class, 'editsponsor']);
    Route::get('/detailsponsor', [AdminController::class, 'detailsponsor']);
    // Route::resource('superadmin/sponsor', [SponsorController::class]);
    Route::get('/berita', [AdminController::class, 'berita']);
    Route::get('/tambahberita', [AdminController::class, 'tambahberita']);
    Route::get('/editberita', [AdminController::class, 'editberita']);
    Route::get('/detailberita', [AdminController::class, 'detailberita']);
    // Route::resource('superadmin/berita', [BeritaController::class]);
    Route::get('/setting', [AdminController::class, 'setting']);
    Route::get('/editsetting', [AdminController::class, 'editsetting']);
    Route::get('/tambahsetting', [AdminController::class, 'tambahsetting']);
    // Route::resource('superadmin/settings', [SettingController::class]);
    Route::get('/rangking', [AdminController::class, 'rangking']);
    Route::get('/tabelrangking', [AdminController::class, 'tabelrangking']);
    // Route::resource('superadmin/ranking', [RankingController::class]);
});

// -> eventadmin atau petugas
Route::middleware('auth','verified','eventadmin')->group(function () {
    Route::get('/eventadmin', [EventAdminController::class, 'index'])->name('eventadmin');
    Route::get('/dashboardpetugas', [EventAdminController::class, 'dashboardpetugas'])->name('dashboardpetugas');
});

// -> panelis atau juri
Route::middleware('auth','verified','panelis')->group(function () {
    Route::get('/panelis', [PanelisController::class, 'index'])->name('panelis');
    Route::get('/dashboardjuri', [PanelisController::class, 'dashboardjuri'])->name('dashboardjuri');
    // Route::get('/rangking', [PanelisControllerController::class, 'rangking']);
    // Route::get('/tabelrangking', [PanelisController::class, 'tabelrangking']);
});

// -> akses double (bisa admin atau juri)

// -- landing page --
Route::get('/kontak', function() {
    return inertia::render('LandingPage/Kontak');
});
Route::get('/informasiberita', function() {
    return inertia::render('LandingPage/InformasiBerita');
});

// -- backup --

// Route::get('/superadmin', function () {
//     return Inertia::render('Roles/Admin/Admin');
// })->middleware(['auth', 'verified', 'admin'])->name('admin');

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified', 'user'])->name('dashboard');
