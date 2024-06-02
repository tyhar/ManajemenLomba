<?php

namespace App\Http\Controllers;

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
        
        return Inertia::render('Roles/Admin/Admin',[
            'UserData' => $user,
            'userstatus' => $userstatus,
            'teamcount' => $teamcount,
            'useradminis' => $useradminis,
            'useradmin' => $useradmin,
            'unreadCount' => $unreadCount,
            'allCount' => $allCount,
            'visitData' => $visitData,
            'allParticipants' => $allParticipants,
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
        return Inertia::render('Roles/Admin/Tim');
    }
    public function tabeltim()
    {
        return Inertia::render('Roles/Admin/Tim/Tabeltim');
    }
    public function detailtim()
    {
        return Inertia::render('Roles/Admin/Tim/Detailtim');
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
        return Inertia::render('Roles/Admin/Adminrangking');
    }
    public function tabelrangking()
    {
        return Inertia::render('Roles/Admin/Rangking/Tabelrangking');
    }
}
