<?php

use Inertia\Inertia;
use App\Models\Sponsor;
use App\Models\Lomba;
use App\Mail\ExampleMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Setting;
use App\Models\Berita;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
//controllers
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\SettingEventController;
use App\Http\Controllers\SettingProjectController;
use App\Http\Controllers\SettingController;
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
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\TimPetugasController;
use App\Http\Controllers\TimSubmissionController;
use App\Http\Controllers\TimPaymentController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\LombaJuriController;
use App\Http\Controllers\ValueController;
use App\Http\Controllers\CreateValueController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\TimSuratController;
use App\Http\Controllers\BobotController;
use App\Http\Controllers\SertifikatLombaController;
use App\Http\Controllers\RangkingController;
use App\Http\Controllers\UserLombaStatusController;
use App\Http\Controllers\CaptchaController;

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
                'logo' => asset('storage/' . $sponsor->logo),
            ];
        }),
        'settings' => Setting::all()->map(function ($setting) {
            return [
                'id' => $setting->id,
                'name' => $setting->name,
                'judul' => $setting->judul,
                'sub_judul' => $setting->sub_judul,
                'judul_des' => $setting->judul_des,
                'deskripsi' => $setting->deskripsi,
                'mulai' => Carbon::parse($setting->mulai)->translatedFormat('d F Y'),
                'berakhir' => Carbon::parse($setting->berakhir)->translatedFormat('d F Y'),
                'des_pendaftaran' => $setting->des_pendaftaran,
                'pengumpulan' => Carbon::parse($setting->pengumpulan)->translatedFormat('d F Y'),
                'des_pengumpulan' => $setting->des_pengumpulan,
                'pengumuman' => Carbon::parse($setting->pengumuman)->translatedFormat('d F Y'),
                'des_pengumuman' => $setting->des_pengumuman,
                'presentasi' => Carbon::parse($setting->presentasi)->translatedFormat('d F Y'),
                'des_presentasi' => $setting->des_presentasi,
                'whatsApp' => $setting->whatsApp,
                'instagram' => $setting->instagram,
                'email' => $setting->email,
                'youtube' => $setting->youtube,
                'logo1' => asset('storage/' . $setting->logo1),
                'logo2' => asset('storage/' . $setting->logo2),
                'logo3' => asset('storage/' . $setting->logo3),
            ];
        }),
        'beritas' => Berita::all()->map(function ($berita) {
            Carbon::setLocale('id');
            return [
                'id' => $berita->id,
                'judul' => $berita->judul,
                'deskripsi_awal' => $berita->deskripsi_awal,
                'tanggal_upload' => Carbon::parse($berita->tanggal_upload)->translatedFormat('d F Y'),
                'images' => $berita->images,
            ];
        }),
        'lombas' => Lomba::all()->map(function ($lomba) {
            return [
                'id' => $lomba->id,
                'name_lomba' => $lomba->name_lomba,
                'picture' => $lomba->picture,
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
Route::post('/check-user-status', [UserController::class, 'checkStatus']);

Route::middleware('auth', 'verified', 'user', 'track.visits')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::resource('overview', OverviewController::class)->only([
        'store',
    ]);

    
    Route::patch('/api/update-status-ketua/{lombaId}', [UserController::class, 'updateStatusKetua'])
    ->name('update-status-ketua');

    // Route::get('/api/user-lomba-status/{user}', [UserLombaStatusController::class, 'getStatus']);
    // Route::post('/api/save-user-lomba-status/{user}', [UserLombaStatusController::class, 'saveStatus']);

    Route::get('/download-certificate/{lomba_id}', [CertificateController::class, 'process'])->name('certificate.download');

   

    Route::resource('profilpeserta', ProfilePesertaController::class)->only([
        'create',
        'store',
    ]);
    Route::resource('submission', SubmissionController::class)->only([
        'show',
    ]);

    Route::post('/submissions/{id}', [SubmissionController::class, 'storeOrUpdate']);
    Route::post('/submissions/{id}/update', [SubmissionController::class, 'storeOrUpdate']);

    // Route::post('/notifikasi/mark-as-read', [NotifikasiController::class, 'markAsRead']);

    Route::post('/notifikasi/mark-all-as-read', [NotifikasiController::class, 'markAllAsRead']);

    Route::post('/team-member/{id}', [TeamMemberController::class, 'store'])->name('team-member.store');

    Route::get('/generate-certificates', [CertificateController::class, 'generateCertificates']);


    Route::get('/notifikasipeserta', [NotifikasiController::class, 'notifikasipeserta']);
    Route::get('/reportpeserta', [UserController::class, 'reportpeserta']);

    Route::get('/detailtimreport/{reg_lomba_id}/{team_id}/{lomba_id}', [UserController::class, 'detailtimreport'])->name('detail.riport');


    Route::resource('daftarlomba', RegLombaController::class)->only([
        'show',
        'store',
    ]);

    Route::get('/tambahanggota/{id}', [RegLombaController::class, 'tambahanggota'])->name('tambahanggota.update');



    Route::resource('datatim', TeamController::class)->only([
        'show',
    ]);

    Route::post('/datatim/{id}', [TeamController::class, 'store'])->name('datatim.update');

    Route::get('/anggotatim', [UserController::class, 'anggotatim']);
    Route::get('/pengumpulankarya', [UserController::class, 'pengumpulankarya']);


});

// -> admin
Route::middleware('auth', 'verified', 'admin')->group(function () {
    Route::get('/superadmin', [AdminController::class, 'index'])->name('admin');
    Route::get('/partisipan', [PartisipanController::class, 'index']);
    // Route::resource('superadmin/partisipan', [PartisipanController::class]);
    Route::get('/api/verified-participants-count', [DashboardController::class, 'getVerifiedParticipantsCount']);
    Route::resource('pesan', MessageController::class)->only([
        'index'
    ]);
    // Route::get('/pesan', [AdminController::class, 'pesan']);
    Route::resource('pesan', MessageController::class)->only([
        'index'
    ]);
    Route::get('/project', [SettingProjectController::class, 'index']);
    Route::get('/setting-project', [SettingProjectController::class, 'edit'])->name('settings.edit');
    Route::post('/setting-project', [SettingProjectController::class, 'store'])->name('settings.store');
    // Route::get('/lomba', [AdminController::class, 'lomba']);
    // Route::get('tambahlomba', [AdminController::class, 'tambahlomba']);
    // Route::get('/editlomba', [AdminController::class, 'editlomba']);
    // Route::get('/detaillomba', [AdminController::class, 'detaillomba']);
    Route::resource('lomba', LombaController::class);

    Route::resource('sertikatlomba', SertifikatLombaController::class)->only([
        'show',
    ]);


    // Route::get('/kriteria', [AdminController::class, 'kriteria']);
    // Route::get('/tambahkriteria', [AdminController::class, 'tambahkriteria']);
    Route::get('/editkriteria', [AdminController::class, 'editkriteria']);
    // Route::get('/detailkriteria', [AdminController::class, 'detailkriteria']);
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('bobot', BobotController::class)->only([
        'edit',
        'update',
        'destroy'
    ]);

    // Route::get('/administrator', [AdminController::class, 'administrator'])->name('administrator');
    // Route::get('/tambahadministrator', [AdminController::class, 'tambahadministrator']);
    // Route::post('/tambahadministrator', [UserController::class, 'store'])->name('daftar.store');
    // Route::get('/editadministrator', [AdminController::class, 'editadministrator']);
    // Route::get('/detailadministrator', [AdminController::class, 'detailadministrator']);
    Route::resource('administrator', AdministratorController::class)->only([
        'index',
        'create',
        'store',
        'show',

    ]);

    Route::put('/administrator/updateStatus/{id}', [AdministratorController::class, 'updateStatus'])->name('administrator.updateStatus');



    







    Route::get('/tim', [AdminController::class, 'tim']);

    Route::get('/tabeltim/{lomba_id}', [AdminController::class, 'tabeltim']);


    Route::get('/detailtim/{team_id}', [AdminController::class, 'detailtim']);
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

    // Route::get('/setting', [AdminController::class, 'setting']);
    // Route::get('/editsetting', [AdminController::class, 'editsetting']);
    // Route::get('/tambahsetting', [AdminController::class, 'tambahsetting']);

    Route::get('/setting', [AdminController::class, 'setting']);
    Route::get('/editsetting', [AdminController::class, 'editsetting']);
    Route::get('/tambahsetting', [AdminController::class, 'tambahsetting']);
    // Route::resource('superadmin/settings', [SettingController::class]);
    Route::resource('setting', SettingController::class);


    // Route::resource('setting', SettingEventController::class)->only([
    //     'index',
    //     'create',
    //     'store',
    //     'edit',
    //     'update',
    // ]);


    Route::get('/rangking', [AdminController::class, 'rangking']);
    
    Route::get('/tabelrangking/{lomba_id}', [AdminController::class, 'tabelrangking']);
    // Route::resource('superadmin/ranking', [RankingController::class]);
});

// -> eventadmin atau petugas
Route::middleware('auth', 'verified', 'eventadmin')->group(function () {
    Route::get('/eventadmin', [EventAdminController::class, 'index'])->name('eventadmin');
    Route::get('/partisipanpetugas', [EventAdminController::class, 'partisipanpetugas']);
    // Route::get('/timpetugas', [EventAdminController::class, 'timpetugas']);
    // Route::get('/timdetail', [EventAdminController::class, 'timdetail']);
    Route::get('/pesanpetugas', [EventAdminController::class, 'pesanpetugas']);
    Route::get('/rangkingpetugas', [EventAdminController::class, 'rangkingpetugas']);
    // Route::get('/petugasrangking', [EventAdminController::class, 'petugasrangking']);
    Route::get('/detailtimpetugas/{reg_lomba_id}', [EventAdminController::class, 'detailtimpetugas']);
    Route::resource('timpetugas', TimPetugasController::class)->only([
        'index',
        'show',
    ]);
    Route::resource('petugasranking', RangkingController::class)->only([
        'show',
    ]);
    Route::put('/teams/{id}/status', [TimPetugasController::class, 'updateStatus']);
});

Route::post('/api/update-status/kelulusan', [RegLombaController::class, 'updateStatus']);

Route::patch('/api/update-status/kelulusan2', [RegLombaController::class, 'updateStatuskelulusan']);


Route::post('/notifications', [NotifikasiController::class, 'store'])->name('notifications.store');
// -> panelis atau juri

Route::middleware('auth', 'verified', 'panelis')->group(function () {
    Route::get('/lombajuri', [LombaJuriController::class, 'index'])->name('panelis');

   

    Route::resource('lombajuri', LombaJuriController::class)->only([
        'show',
    ]);


    Route::post('/api/update-status/nilai', [RegLombaController::class, 'updateStatusnilai']);

    Route::resource('value', ValueController::class)->only([
        'index',
        'store',
    ]);


    Route::get('/value/edit/{reg_lomba_id}/{lomba_id}', [ValueController::class, 'edit'])->name('value.edit');
    Route::put('/value/{id}', [ValueController::class, 'update'])->name('value.update');


    Route::get('/value/show/{reg_lomba_id}/{team_id}', [ValueController::class, 'show'])->name('value.show');


    Route::get('/value/create/{reg_lomba_id}/{team_id}/{lomba_id}', [CreateValueController::class, 'create'])->name('value.create');

      



    Route::get('/tabellomba', [PanelisController::class, 'tabellomba']);
    Route::get('/rangkingjuri', [PanelisController::class, 'rangkingjuri']);

    Route::get('/tabelrangkingjuri', [PanelisController::class, 'tabelrangkingjuri']);
    // Route::get('/nilai', [PanelisController::class, 'nilai']);
    // Route::get('/editnilai', [PanelisController::class, 'editnilai']);
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


Route::get('berita/{berita}/detail', [BeritaController::class, 'detail']);

Route::get('/api/unread-notifikasi', [NotifikasiController::class, 'notifikasiByTeamId']);


Route::get('/export-partisipan', [ExcelController::class, 'exportPartisipan'])->name('export.partisipan');
Route::get('/export-team', [ExcelController::class, 'exportTeam'])->name('export.team');
Route::resource('submissionshow', TimSubmissionController::class)->only([
    'show'
]);
Route::get('/submissionsurat/{id}', [TimSuratController::class, 'show'])->name('submissionsurat.show');

Route::resource('datatimshow', TimPaymentController::class)->only([
    'show',
]);
Route::resource('surat', TimSuratController::class)->only([
    'show',
]);
Route::get('/detailpeserta/{id}', [UserController::class, 'show'])->name('detailpeserta.show');

Route::post('/api/notifikasi/{id}/mark-as-read', [NotifikasiController::class, 'markAsRead']);

Route::get('/captcha-image', [CaptchaController::class, 'getCaptchaImage'])->name('captcha-image');

Route::get('/send-test-email', function () {
    Mail::to('recipient@example.com')->send(new ExampleMail());
    return 'Email sent!';
});

Route::get('/storage-link', function () {
    // Define the target folder, which is the storage path for public files
    $targetFolder = storage_path('app/public');
    
    // Define the link folder, which is the document root path plus '/storage'
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    
    // Create the symbolic link
    symlink($targetFolder, $linkFolder);
    
    // Optional: return a response to confirm the link was created
    return 'Storage link created successfully!';
});
// -- backup --
// Route::get('/api/logo', [LogoController::class, 'getLogo']);
// Route::get('/superadmin', function () {
Route::controller(GoogleController::class)->group(function () {
    Route::get('authorized/google', 'googlepage')->name('auth.google');
    Route::get('authorized/google/callback', 'handleGoogleCallback');
});