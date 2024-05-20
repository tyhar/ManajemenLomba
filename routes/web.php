<?php

use Inertia\Inertia;
use App\Models\Sponsor;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;

//controllers
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingEventController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PanelisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\PartisipanController;
use App\Http\Controllers\EventAdminController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\ProfilePesertaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\RegLombaController;

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



    Route::get('/detailpeserta/{id}', [UserController::class, 'show']);

    Route::resource('profilpeserta', ProfilePesertaController::class)->only([
        'create',
        'store',
    ]);
    Route::resource('submission', SubmissionController::class)->only([
        'create',
        'store',
    ]);


    Route::get('/notifikasipeserta', [UserController::class, 'notifikasipeserta']);
    Route::get('/reportpeserta', [UserController::class, 'reportpeserta']);
    Route::get('/detailtimreport', [UserController::class, 'detailtimreport']);


    Route::resource('daftarlomba', RegLombaController::class)->only([
        'index',
        'show',
        'store',
    ]);

    // Route::get('/search-users', [RegLombaController::class, 'search'])->name('search-users');

    Route::resource('datatim', TeamController::class)->only([
        'create',
        'store',
        'show',
    ]);

    Route::get('/anggotatim', [UserController::class, 'anggotatim']);
    Route::get('/pengumpulankarya', [UserController::class, 'pengumpulankarya']);
});

// -> admin
Route::middleware('auth', 'verified', 'admin')->group(function () {
    Route::get('/superadmin', [AdminController::class, 'index'])->name('admin');
    Route::get('/partisipan', [PartisipanController::class, 'index']);
    Route::get('/export-partisipan', [ExcelController::class, 'export'])->name('export.partisipan');
    // Route::resource('superadmin/partisipan', [PartisipanController::class]);
    Route::get('/api/verified-participants-count', [DashboardController::class, 'getVerifiedParticipantsCount']);
    Route::resource('pesan', MessageController::class)->only([
        'index'
    ]);
    // Route::get('/pesan', [AdminController::class, 'pesan']);
    Route::resource('pesan', MessageController::class)->only([
        'index'
    ]);

    // Route::get('/lomba', [AdminController::class, 'lomba']);
    // Route::get('tambahlomba', [AdminController::class, 'tambahlomba']);
    // Route::get('/editlomba', [AdminController::class, 'editlomba']);
    // Route::get('/detaillomba', [AdminController::class, 'detaillomba']);
    Route::resource('lomba', LombaController::class);

    // Route::get('/kriteria', [AdminController::class, 'kriteria']);
    // Route::get('/tambahkriteria', [AdminController::class, 'tambahkriteria']);
    // Route::get('/editkriteria', [AdminController::class, 'editkriteria']);
    // Route::get('/detailkriteria', [AdminController::class, 'detailkriteria']);
    Route::resource('kriteria', KriteriaController::class);

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

    Route::get('/berita', [AdminController::class, 'berita']);
    Route::get('/tambahberita', [AdminController::class, 'tambahberita']);
    Route::get('/editberita', [AdminController::class, 'editberita']);
    Route::get('/detailberita', [AdminController::class, 'detailberita']);
    // Route::resource('superadmin/berita', [BeritaController::class]);

    // Route::get('/setting', [AdminController::class, 'setting']);
    // Route::get('/editsetting', [AdminController::class, 'editsetting']);
    // Route::get('/tambahsetting', [AdminController::class, 'tambahsetting']);
    Route::resource('setting', SettingEventController::class)->only([
        'index',
        'create',
        'store',
        'edit',
        'update',
    ]);


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
    Route::get('/nilai', [PanelisController::class, 'nilai']);
    Route::get('/editnilai', [PanelisController::class, 'editnilai']);
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
    'store',
    'edit',
]);
Route::patch('/messages/{message}/status', [MessageController::class, 'updateStatus'])->name('messages.updateStatus');

Route::get('/informasiberita', function () {
    return inertia::render('Utama/InformasiBerita');
});

Route::get('/api/unread-messages', [MessageController::class, 'getUnreadMessageCount']);

Route::get('/api/all-messages', [MessageController::class, 'getAllMessageCount']);

Route::get('/api/all-participants', [MessageController::class, 'getAllparticipants']);



// -- backup --
// Route::get('/api/logo', [LogoController::class, 'getLogo']);
// Route::get('/superadmin', function () {
Route::controller(GoogleController::class)->group(function () {
    Route::get('authorized/google', 'googlepage')->name('auth.google');
    Route::get('authorized/google/callback', 'handleGoogleCallback');
});