<?php

use Inertia\Inertia;
use App\Models\Sponsor;

//Models
use Illuminate\Support\Facades\Route;

//controllers
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PanelisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EventAdminController;
use App\Http\Controllers\AdministratorController;

//default breeze
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'sponsors' => Sponsor::all()->map(function ($sponsor) {
            return [
                'id' => $sponsor->id,
                'name' => $sponsor->name,
                'link_file' => $sponsor->link_file,
                'logo' => asset('storage/' . $sponsor->logo)
            ];
        }),
    ]);
})->name('welcome');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// -- multi auth roles --
//dont forget to add controller class or any other import needed

// -> user atau peserta
Route::middleware('auth', 'verified', 'user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/detailpeserta', [UserController::class, 'detailpeserta']);
    Route::get('/profilpeserta', [UserController::class, 'profilpeserta']);
    Route::get('/notifikasipeserta', [UserController::class, 'notifikasipeserta']);
    Route::get('/reportpeserta', [UserController::class, 'reportpeserta']);
    Route::get('/detailtimreport', [UserController::class, 'detailtimreport']);
    Route::get('/daftarlomba', [UserController::class, 'daftarlomba']);
    Route::get('/datatim', [UserController::class, 'datatim']);
    Route::get('/anggotatim', [UserController::class, 'anggotatim']);
    Route::get('/pengumpulankarya', [UserController::class, 'pengumpulankarya']);
});

// -> admin
Route::middleware('auth', 'verified', 'admin')->group(function () {
    Route::get('/superadmin', [AdminController::class, 'index'])->name('admin');
    Route::get('/partisipan', [AdminController::class, 'partisipan']);
    // Route::resource('superadmin/partisipan', [PartisipanController::class]);

    // Route::get('/pesan', [AdminController::class, 'pesan']);
    Route::resource('pesan', MessageController::class)->only([
        'index'
    ]);

    Route::get('/lomba', [AdminController::class, 'lomba']);
    Route::get('tambahlomba', [AdminController::class, 'tambahlomba']);
    Route::get('/editlomba', [AdminController::class, 'editlomba']);
    Route::get('/detaillomba', [AdminController::class, 'detaillomba']);
    // Route::resource('superadmin/lomba', [LombaController::class]);

    Route::get('/kriteria', [AdminController::class, 'kriteria']);
    Route::get('/tambahkriteria', [AdminController::class, 'tambahkriteria']);
    Route::get('/editkriteria', [AdminController::class, 'editkriteria']);
    Route::get('/detailkriteria', [AdminController::class, 'detailkriteria']);
    // Route::resource('superadmin/kriteria', [KriteriaController::class]);

    // Route::get('/administrator', [AdminController::class, 'administrator'])->name('administrator');
    // Route::get('/tambahadministrator', [AdminController::class, 'tambahadministrator']);
    // Route::post('/tambahadministrator', [UserController::class, 'store'])->name('daftar.store');
    // Route::get('/editadministrator', [AdminController::class, 'editadministrator']);
    // Route::get('/detailadministrator', [AdminController::class, 'detailadministrator']);
    Route::resource('administrator', AdministratorController::class);

    Route::get('/tim', [AdminController::class, 'tim']);
    Route::get('/tabeltim', [AdminController::class, 'tabeltim']);
    Route::get('/detailtim', [AdminController::class, 'detailtim']);
    // Route::resource('superadmin/tim', [TimController::class]);

    // Route::resource('superadmin/sponsor', SponsorController::class);
    Route::resource('sponsor', SponsorController::class);

    Route::get('/berita/tambah-berita', [BeritaController::class, 'tambahberita']);
    Route::get('/berita', [BeritaController::class, 'berita'])->name('berita.index');
    Route::post('/berita', [BeritaController::class, 'store']);
    Route::delete('/berita/{berita}', [BeritaController::class, 'destroy']);
    Route::get('/berita/{berita}/edit-berita', [BeritaController::class, 'editberita']);
    Route::put('/berita/{berita}', [BeritaController::class, 'update']);
    Route::get('/berita/{berita}/detail-berita', [BeritaController::class, 'detailberita']);

    Route::get('/setting', [AdminController::class, 'setting']);
    Route::get('/editsetting', [AdminController::class, 'editsetting']);
    Route::get('/tambahsetting', [AdminController::class, 'tambahsetting']);
    // Route::resource('superadmin/settings', [SettingController::class]);

    Route::get('/rangking', [AdminController::class, 'rangking']);
    Route::get('/tabelrangking', [AdminController::class, 'tabelrangking']);
    // Route::resource('superadmin/ranking', [RankingController::class]);
});

// -> eventadmin atau petugas
Route::middleware('auth', 'verified', 'eventadmin')->group(function () {
    Route::get('/eventadmin', [EventAdminController::class, 'index'])->name('eventadmin');
    Route::get('/partisipanpetugas', [EventAdminController::class, 'partisipanpetugas']);
    Route::get('/timpetugas', [EventAdminController::class, 'timpetugas']);
    Route::get('/timdetail', [EventAdminController::class, 'timdetail']);
    Route::get('/pesanpetugas', [EventAdminController::class, 'pesanpetugas']);
    Route::get('/rangkingpetugas', [EventAdminController::class, 'rangkingpetugas']);
    Route::get('/petugasrangking', [EventAdminController::class, 'petugasrangking']);
});

// -> panelis atau juri
Route::middleware('auth', 'verified', 'panelis')->group(function () {
    Route::get('/panelis', [PanelisController::class, 'index'])->name('panelis');
    Route::get('/lombajuri', [PanelisController::class, 'lombajuri']);
    Route::get('/tabellomba', [PanelisController::class, 'tabellomba']);
    Route::get('/rangkingjuri', [PanelisController::class, 'rangkingjuri']);
    Route::get('/tabelrangkingjuri', [PanelisController::class, 'tabelrangkingjuri']);
    Route::get('/editnilai', [PanelisController::class, 'editnilai']);
    Route::get('/nilai', [PanelisController::class, 'nilai']);
    Route::get('/timdetailjuri', [PanelisController::class, 'timdetailjuri']);
    // Route::get('/dashboardjuri', [PanelisController::class, 'dashboardjuri'])->name('dashboardjuri');
    // Route::get('/rangking', [PanelisControllerController::class, 'rangking']);
    // Route::get('/tabelrangking', [PanelisController::class, 'tabelrangking']);
});

// -> akses double (bisa admin atau juri)
// -> akses double (bisa admin atau petugas)

// -- landing page --
// Route::get('/kontak', function() {
//     return inertia::render('Utama/Kontak');
// });
Route::resource('pesan', MessageController::class)->only([
    'create',
    'store'
]);

Route::get('/informasiberita', function () {
    return inertia::render('Utama/InformasiBerita');
});

// -- backup --

// Route::get('/superadmin', function () {
//     return Inertia::render('Roles/Admin/Admin');
// })->middleware(['auth', 'verified', 'admin'])->name('admin');

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified', 'user'])->name('dashboard');