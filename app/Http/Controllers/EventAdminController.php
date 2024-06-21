<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Value;
use App\Models\Message;
use App\Http\Resources\UserResource;
use App\Models\Team;
use App\Models\Visit;
use App\Models\TeamMember;
use App\Models\Lomba;
use App\Models\KriteriaLomba;
use App\Models\Setting;
use App\Models\Reg_Lomba;
use App\Models\Submission;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\TeamResource;

class EventAdminController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        $teamcount = Team::count();
     
        $useradminis = User::whereIn('role', [1, 2, 4])->count();
        $unreadCount = Message::where('status', 'belum_dibaca')->count();
        $allCount = Message::count();
        $visitData = Visit::all();
        $allParticipants = User::count();

        // Count users with role 1
        $useradmin = User::where('role', 1)->count();

        $userstatus = User::where('email_verification_status', 'verified')->count();
        $user = Auth::user();
        
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);
        
        return Inertia::render('Roles/EventAdmin/Dashboardpetugas',[
            'UserData' => $user,
            'userstatus' => $userstatus,
            'teamcount' => $teamcount,
            'useradminis' => $useradminis,
            'useradmin' => $useradmin,
            'unreadCount' => $unreadCount,
            'allCount' => $allCount,
            'visitData' => $visitData,
            'allParticipants' => $allParticipants,
            'settings' => $settings,
        ]);
    }

    public function partisipanpetugas()
    {
        // Fetch users with role 3
        $users = User::where('role', 3)->get();
        $settings = Setting::all();
        $unreadCount = Message::where('status', 'belum_dibaca')->count();
        $userResources = UserResource::collection($users);
    
        return inertia::render('Roles/EventAdmin/Partisipanpetugas', [
            'partisipans' => $userResources,
            'settings' => $settings,
            'unreadCount' => $unreadCount,

        ]);
    }
    




    public function timpetugas()
    {
        return Inertia::render('Roles/EventAdmin/Timpetugas',
        
    );
    }
    public function timdetail()
    {
        return Inertia::render('Roles/EventAdmin/Tim/Timdetail');
    }


    public function pesanpetugas()
    {
        $settings = Setting::all();
        $unreadCount = Message::where('status', 'belum_dibaca')->count();
        $user = Auth::user();
        $messages = Message::all()->map(function ($message) use ($user) {
            return [
                'id' => $message->id,
                'name' => $message->name,
                'email' => $message->email,
                'phone' => $message->phone,
                'value' => $message->value,
                'status' => $message->status,
                'userData' => [
                    'name' => $user->name,
                    'username' => $user->username,
                ],
            ];
        });

        return Inertia::render('Roles/EventAdmin/Pesanpetugas', [
            'messages' => $messages,
            'settings' => $settings,
            'unreadCount' => $unreadCount,
        ]);
    }

    public function rangkingpetugas()
    {
        $settings = Setting::all();
        $unreadCount = Message::where('status', 'belum_dibaca')->count();
        $lomba = Lomba::all();
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);
        return Inertia::render('Roles/EventAdmin/Rangkingpetugas', [
            'UserData' => $user,
            'lombas' => $lomba,
            'settings' => $settings,
            'unreadCount' => $unreadCount,

        ]);
    }
    public function petugasrangking()
    {
        return Inertia::render('Roles/EventAdmin/Rangking/Petugasrangking');
    }

    public function detailtimpetugas($reg_lomba_id)
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();
        
        // Ambil reg_lomba menggunakan ID yang diberikan dan pastikan lomba_id cocok
        $regLomba = Reg_Lomba::with(['team', 'lomba', 'submission'])->findOrFail($reg_lomba_id);
        
        // Dapatkan team_id dari reg_lomba
        $team_id = $regLomba->team_id;
        $lomba_id = $regLomba->lomba_id;
    
        // Ambil team menggunakan team_id dari reg_lomba dan pastikan lomba_id cocok
        $team = Team::with(['lomba', 'user'])
            ->where('id', $team_id)
            ->where('lomba_id', $lomba_id)
            ->firstOrFail();
    
        // Ambil submission yang terkait dengan team dan lomba_id
        $submission = Submission::where('team_id', $team->id)
            ->where('lomba_id', $lomba_id)
            ->first();
    
        $value = Value::with(['reg_lomba', 'kriteria_lomba'])
            ->where('reg_lomba_id', $reg_lomba_id)
            ->firstOrFail();
        
        // Ambil kriterias terkait dengan lomba_id dan tambahkan value_count
        $kriterias = KriteriaLomba::with(['kriteria'])
            ->whereHas('kriteria', function($query) use ($value) {
                $query->where('lomba_id', $value->reg_lomba->lomba_id);
            })->get();
        
        // Ambil value_count untuk setiap kriteria
        foreach ($kriterias as $kriteria) {
            // Mengambil value_count berdasarkan reg_lomba_id dan kriteria_lomba_id di tabel values
            $valueEntry = Value::where('reg_lomba_id', $value->reg_lomba_id)
                               ->where('kriteria_lomba_id', $kriteria->id)
                               ->first();
        
            // Jika entri ditemukan, set value_count, jika tidak, set ke null atau nilai default
            $kriteria->value_count = $valueEntry ? $valueEntry->value_count : null;
        }
    
        $teamMembers = TeamMember::where('team_id', $team->id)
            ->with(['user:id,name,nik,photo,instansi'])
            ->get()
            ->map(function($teamMember) {
                return [
                    'name' => $teamMember->user->name,
                    'nik' => $teamMember->user->nik,
                    'photo' => $teamMember->user->photo,
                    'instansi' => $teamMember->user->instansi,
                    'role' => $teamMember->role,
                ];
            });
    
        $settings = Setting::all();
    
        return Inertia::render('Roles/EventAdmin/Rangking/Detailtimpetugas', [
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
    
}