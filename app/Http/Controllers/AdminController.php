<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;
use App\Http\Resources\UserResource;
use App\Models\Team;
use App\Models\Visit;
use App\Models\TeamMember;
use App\Models\Lomba;
use App\Models\Reg_Lomba;
use App\Models\Submission;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index()
    {
        $teamcount = Team::count();
        $setting = Setting::all();
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

        return Inertia::render('Roles/Admin/Admin', [
            'UserData' => $user,
            'userstatus' => $userstatus,
            'teamcount' => $teamcount,
            'useradminis' => $useradminis,
            'useradmin' => $useradmin,
            'unreadCount' => $unreadCount,
            'allCount' => $allCount,
            'visitData' => $visitData,
            'allParticipants' => $allParticipants,
            'settings' => $setting,
        ]);
    }

    public function partisipan()
    {
        return Inertia::render('Roles/Admin/Partisipan');
    }
    // public function pesan()
    // {
    //     return Inertia::render('Roles/Admin/Pesan');
    // }

    //LOMBA
    // public function lomba()
    // {
    //     return Inertia::render('Roles/Admin/Lomba');
    // }
    // public function tambahlomba()
    // {
    //     return Inertia::render('Roles/Admin/Lomba/Tambahlomba');
    // }
    // public function editlomba()
    // {
    //     return Inertia::render('Roles/Admin/Lomba/Editlomba');
    // }
    // public function detaillomba()
    // {
    //     return Inertia::render('Roles/Admin/Lomba/Detaillomba');
    // }

    //KRITERIA
    public function kriteria()
    {
        return Inertia::render('Roles/Admin/Lomba');
    }
    public function tambahkriteria()
    {
        return Inertia::render('Roles/Admin/Kriteria/Tambahkriteria');
    }
    public function editkriteria()
    {
        return Inertia::render('Roles/Admin/Kriteria/Editkriteria');
    }
    public function detailkriteria()
    {
        return Inertia::render('Roles/Admin/Kriteria/Detailkriteria');
    }

    //ADMINISTRATOR
    // public function administrator()
    // {
    //     return Inertia::render('Roles/Admin/Administrator');
    // }
    // public function tambahadministrator()
    // {
    //     return Inertia::render('Roles/Admin/Administrator/Tambahadministrator');
    // }
    // public function detailadministrator()
    // {
    //     return Inertia::render('Roles/Admin/Administrator/Detailadministrator');
    // }

    //TIM
    public function tim()
    {
        $setting = Setting::all();
        $unreadCount = Message::where('status', 'belum_dibaca')->count();
        $lomba = Lomba::all();

        return Inertia::render('Roles/Admin/Tim', [
            'lombas' => $lomba,
            'settings' => $setting,
            'unreadCount' => $unreadCount,
        ]);
    }

    public function tabeltim($lomba_id)
    {
        // Query to get all teams with related lomba and user based on the lomba_id
        $teams = Team::with(['lomba', 'user'])->where('lomba_id', $lomba_id)->get();

        // Get all settings
        $setting = Setting::all();

        // Count unread messages
        $unreadCount = Message::where('status', 'belum_dibaca')->count();

        $lomba = Lomba::findOrFail($lomba_id);
        // Render the Inertia page with the necessary data
        return Inertia::render('Roles/Admin/Tim/Tabeltim', [
            'settings' => $setting,
            'unreadCount' => $unreadCount,
            'teams' => $teams,
            'lomba' => $lomba,
        ]);
    }


    public function detailtim($team_id)
    {
        $setting = Setting::all();
        // Get the authenticated user
        $user = Auth::user();

        // Fetch the team using the provided ID
        $team = Team::with(['lomba', 'user'])->findOrFail($team_id);

        // Fetch the reg_lomba related to the team
        // Assuming there is a relation 'reg_lomba' in the Team model
        $regLomba = $team->regLombas()->with('lomba', 'submission')->first();

        // Fetch the submission related to the team
        $submission = Submission::where('team_id', $team->id)->first();

        // Fetch the team members related to the team
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

        return Inertia::render('Roles/Admin/Tim/Detailtim', [
            'userData' => $user,
            'reg_lombas' => $regLomba,
            'team' => $team,
            'submissions' => $submission,
            'members' => $teamMembers,
            'settings' => $setting,
        ]);
    }








    //SPONSOR
    public function sponsor()
    {
        return Inertia::render('Roles/Admin/Sponsor');
    }
    public function tambahsponsor()
    {
        return Inertia::render('Roles/Admin/Sponsor/Tambahsponsor');
    }
    public function editsponsor()
    {
        return Inertia::render('Roles/Admin/Sponsor/Editsponsor');
    }
    public function detailsponsor()
    {
        return Inertia::render('Roles/Admin/Sponsor/Detailsponsor');
    }

    //BERITA
    public function berita()
    {
        return Inertia::render('Roles/Admin/Berita');
    }
    public function tambahberita()
    {
        return Inertia::render('Roles/Admin/Berita/Tambahberita');
    }
    public function editberita()
    {
        return Inertia::render('Roles/Admin/Berita/Editberita');
    }
    public function detailberita()
    {
        return Inertia::render('Roles/Admin/Berita/Detailberita');
    }

    //SETTING
    public function setting()
    {
        return Inertia::render('Roles/Admin/Setting');
    }
    public function tambahsetting()
    {
        return Inertia::render('Roles/Admin/Setting/Tambahsetting');
    }
    public function editsetting()
    {
        return Inertia::render('Roles/Admin/Setting/Editsetting');
    }

    //RANKING
    public function rangking()
    {
        $settings = Setting::all();
        $unreadCount = Message::where('status', 'belum_dibaca')->count();
        $lomba = Lomba::all();
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);
        return Inertia::render('Roles/Admin/Adminrangking', [
            'UserData' => $user,
            'lombas' => $lomba,
            'settings' => $settings,
            'unreadCount' => $unreadCount,
        ]);
    }
    public function tabelrangking($lomba_id)
    {
        $user = Auth::user();
        $settings = Setting::all();
        $unreadCount = Message::where('status', 'belum_dibaca')->count();

        // Mengambil semua entri Reg_Lomba dengan lomba_id yang sesuai
        $regLombas = Reg_Lomba::where('lomba_id', $lomba_id)->with('lomba', 'team', 'submission')->get();

        return Inertia::render('Roles/Admin/Rangking/Tabelrangking', [
            'UserData' => $user,
            'reg_lombas' => $regLombas,
            'settings' => $settings,
            'unreadCount' => $unreadCount,
        ]);
    }

}