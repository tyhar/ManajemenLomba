<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Value;
use App\Models\Setting;
use App\Models\KriteriaLomba;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\Lomba;
use App\Models\Visit;
use App\Models\Reg_Lomba;
use App\Models\Submission;
use App\Models\Notifikasi;
use App\Models\UserStatus;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Redirect;
use Inertia\Response;

class UserController extends Controller
{

    public function index(Request $request)
{
    $settings = Setting::all();
    $user = Auth::user();

    // Fetch UserStatus entries based on user_id and filter the status_ketua_team
    $userStatuses = UserStatus::where('user_id', $user->id)
        ->whereIn('status_ketua_team', ['terdaftar', 'belum_terdaftar', 'sudah_submit'])
        ->get();

    // Collect the relevant Lomba IDs from the userStatuses
    $lombaIds = $userStatuses->pluck('lomba_id')->unique();

    // Fetch all Lomba entries
    $lombas = Lomba::all();

    // Add user status information to each Lomba entry
    $lombas = $lombas->map(function ($lomba) use ($userStatuses) {
        $userStatus = $userStatuses->firstWhere('lomba_id', $lomba->id);
        $lomba->is_registered = !is_null($userStatus);
        $lomba->status_ketua_team = $userStatus ? $userStatus->status_ketua_team : null;
        return $lomba;
    });

    // Fetch team and notifications
    // $team = $user->team()->with('user')->first();

    // If the team exists, count the unread notifications for that team
    $notifCount = null;
    if ($user) {
        $notifCount = Notifikasi::where('status', 'belum_dibaca')
            ->where('user_id', $user->id)
            ->count();
    }

    // Fetch visit data for the chart
    $visitData = Visit::select('visit_month', 'visit_count')->get();

    return Inertia::render('Roles/User/Dashboard', [
        'initialUserStatus' => $userStatuses->pluck('status_ketua_team')->first(), // Keeping this for initial status if needed
        'lombas' => $lombas,
        'userData' => $user,
        'notifCount' => $notifCount,
        'settings' => $settings,
        'visitData' => $visitData,
        'userStatuses' => $userStatuses, // Pass userStatuses to the view
    ]);
}


    public function overviewpeserta()
    {
        return Inertia::render('Roles/User/Overviewpeserta');
    }
    public function show($id)
    {
        $settings = Setting::all();
        $lomba = Lomba::findOrFail($id);
        $user = Auth::user();
    
        // Check if user is authenticated
        if ($user) {
            Inertia::share('userData', [
                'name' => $user->name,
                'username' => $user->username,
            ]);
        } else {
            // Provide default values or handle unauthenticated user
            Inertia::share('userData', [
                'name' => '',
                'username' => '',
            ]);
        }
    
        return Inertia::render('Roles/User/Detailpeserta', [
            'DataUser' => $user,
            'lombax' => $lomba,
            'settings' => $settings,
        ]);
    }
    

    public function profilpeserta()
    {
        return Inertia::render('Roles/User/Profilpeserta');
    }
    public function notifikasipeserta()
    {
        return Inertia::render('Roles/User/Notifikasipeserta');
    }



 public function reportpeserta()
{
    
    $settings = Setting::all();
    $user = Auth::user();
    // Fetch all reg_lombas records related to the user
    $reg_lombas = Reg_Lomba::with(['team', 'lomba', 'submission'])
        ->where('user_id', $user->id)
        ->get();

        $notifCount = null;
        if ($user) {
            $notifCount = Notifikasi::where('status', 'belum_dibaca')
                ->where('user_id', $user->id)
                ->count();
        }
     
    return Inertia::render('Roles/User/Reportpeserta', [
        'notifCount' => $notifCount,
        'userData' => $user,
        'reg_lombas' => $reg_lombas,
        'settings' => $settings,
        
    ]);
}

public function detailtimreport($reg_lomba_id, $team_id, $lomba_id)
{
    $settings = Setting::all();
    // Ambil pengguna yang sedang login
    $user = Auth::user();

    // Ambil reg_lomba menggunakan ID yang diberikan dan pastikan lomba_id cocok
    $regLomba = Reg_Lomba::with(['team', 'lomba', 'submission'])->findOrFail($reg_lomba_id);

    // Ambil team menggunakan ID yang diberikan dan pastikan lomba_id cocok
    $team = Team::with(['lomba', 'user'])
        ->where('id', $team_id)
        ->where('lomba_id', $lomba_id)
        ->firstOrFail();

    // Ambil submission yang terkait dengan team dan lomba_id
    $submission = Submission::where('team_id', $team->id)
        ->where('lomba_id', $lomba_id)
        ->first();

    // Ambil Value atau null jika tidak ditemukan
    $value = Value::with(['reg_lomba', 'kriteria_lomba'])
        ->where('reg_lomba_id', $reg_lomba_id)
        ->first();

    // Ambil kriterias terkait dengan lomba_id jika value ditemukan, jika tidak, kosongkan
    $kriterias = $value ? KriteriaLomba::with(['kriteria'])
        ->whereHas('kriteria', function ($query) use ($value) {
            $query->where('lomba_id', $value->reg_lomba->lomba_id);
        })->get() : collect();

    // Ambil value_count untuk setiap kriteria jika kriterias tidak kosong
    if ($kriterias->isNotEmpty()) {
        foreach ($kriterias as $kriteria) {
            // Mengambil value_count berdasarkan reg_lomba_id dan kriteria_lomba_id di tabel values
            $valueEntry = Value::where('reg_lomba_id', $reg_lomba_id)
                ->where('kriteria_lomba_id', $kriteria->id)
                ->first();

            // Jika entri ditemukan, set value_count, jika tidak, set ke null atau nilai default
            $kriteria->value_count = $valueEntry ? $valueEntry->value_count : null;
        }
    }

    $teamMembers = TeamMember::where('team_id', $team->id)
        ->with(['user:id,name,nik,photo,instansi'])
        ->get()
        ->map(function ($teamMember) {
            return [
                'name' => $teamMember->user->name,
                'nik' => $teamMember->user->nik,
                'photo' => $teamMember->user->photo,
                'instansi' => $teamMember->user->instansi,
                'role' => $teamMember->role,
            ];
        });

    // Kembalikan data ke view
    return Inertia::render('Roles/User/Report/Detailtimreport', [
        'userData' => $user,
        'reg_lombas' => $regLomba,
        'team' => $team,
        'submissions' => $submission,
        'members' => $teamMembers,
        'kriterias' => $kriterias,
        'value' => $value,
        'settings' => $settings,
    ]);
}


    public function daftarlomba()
    {
        return Inertia::render('Roles/User/Daftarlomba');
    }
    public function datatim()
    {
        return Inertia::render('Roles/User/Daftar/Datatim');
    }
    public function anggotatim()
    {
        return Inertia::render('Roles/User/Daftar/Anggotatim');
    }
    public function pengumpulankarya()
    {
        return Inertia::render('Roles/User/Daftar/Pengumpulankarya');
    }



    
    public function checkStatus(Request $request)
    {
        $user = User::where('email', $request->login)->orWhere('username', $request->login)->first();
    
        if ($user) {
            return response()->json(['status' => $user->status]);
        } else {
            return response()->json(['status' => 'not_found'], 404);
        }
    }
    

    public function updateStatusKetua(Request $request, $lombaId)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $user = Auth::user();
        
        // Validasi status yang diterima dalam request
        $validated = $request->validate([
            'status' => 'required|in:terdaftar,sudah_submit',
        ]);
        
        // Cari atau buat entri UserStatus untuk user dan lomba
        $userStatus = UserStatus::firstOrNew(['user_id' => $user->id, 'lomba_id' => $lombaId]);
        $userStatus->status_ketua_team = $validated['status'];
        $userStatus->save();
    
        return response()->json(['message' => 'Status updated successfully']);
    }
    
    
}
