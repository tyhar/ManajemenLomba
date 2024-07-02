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
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\Lomba;
use App\Models\Reg_Lomba;
use App\Models\Submission;
use Illuminate\Support\Facades\Redirect;


class PanelisController extends Controller
{


    // public function index()
    // {
    //     $teamcount = Team::count();
    //     // Count users with roles 1, 2, or 4
    //     $useradminis = User::whereIn('role', [1, 2, 4])->count();
    //     $unreadCount = Message::where('status', 'belum_dibaca')->count();
    //     $allCount = Message::count();
    //     $visitData = Visit::all();
    //     $allParticipants = User::count();

    //     // Count users with role 1
    //     $useradmin = User::where('role', 1)->count();

    //     $userstatus = User::where('email_verification_status', 'verified')->count();
    //     $user = Auth::user();

    //     Inertia::share('userData', [
    //         'name' => $user->name,
    //         'username' => $user->username,
    //     ]);


    //     return Inertia::render('Roles/Panelis/Dashboardjuri',[
    //         'UserData' => $user,
    //         'userstatus' => $userstatus,
    //         'teamcount' => $teamcount,
    //         'useradminis' => $useradminis,
    //         'useradmin' => $useradmin,
    //         'unreadCount' => $unreadCount,
    //         'allCount' => $allCount,
    //         'visitData' => $visitData,
    //         'allParticipants' => $allParticipants,
    //     ]);
    // }



    //RANKING
    public function rangkingjuri()
    {
        $user = auth()->user();
        $regLombas = Reg_Lomba::with('lomba','submission','team')->get();

       

        $settings = Setting::all();
        return Inertia::render('Roles/Panelis/Rangkingjuri', [

            'name' => auth()->user()->name,
            'username' => auth()->user()->username,
            'reg_lombas' => $regLombas,
            
            'settings' => $settings,

        ]);

    }
    public function tabelrangkingjuri()
    {
        return Inertia::render('Roles/Panelis/Rangking/Tabelrangkingjuri');
    }
    public function lombajuri()
    {
        return Inertia::render('Roles/Panelis/Lombajuri');
    }
    public function tabellomba()
    {
        return Inertia::render('Roles/Panelis/Lomba/Tabellomba');
    }
    public function nilai()
    {
        return Inertia::render('Roles/Panelis/Lomba/Nilai');
    }
    public function editnilai()
    {
        return Inertia::render('Roles/Panelis/Lomba/Editnilai');
    }
    public function timdetailjuri()
    {
        return Inertia::render('Roles/Panelis/Lomba/Timdetailjuri');
    }

    // public function getVisits()
    // {
    //     $visits = Visit::all();
    //     return response()->json($visits);
    // }
}