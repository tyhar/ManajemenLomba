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
use App\Http\Resources\TeamResource;

class EventAdminController extends Controller
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
        ]);
    }

    public function partisipanpetugas()
    {


        $user = UserResource::collection(User::all());

        return inertia::render('Roles/EventAdmin/Partisipanpetugas', [

            'partisipans' => $user,

        ]);

    }




    public function timpetugas()
    {
        return Inertia::render('Roles/EventAdmin/Timpetugas');
    }
    public function timdetail()
    {
        return Inertia::render('Roles/EventAdmin/Tim/Timdetail');
    }


    public function pesanpetugas()
    {
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
        ]);
    }

    public function rangkingpetugas()
    {
        $lomba = Lomba::all();
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);
        return Inertia::render('Roles/EventAdmin/Rangkingpetugas', [
            'UserData' => $user,
            'lombas' => $lomba,
        ]);
    }
    public function petugasrangking()
    {
        return Inertia::render('Roles/EventAdmin/Rangking/Petugasrangking');
    }


    public function detailtimpetugas($id)
    {
        $user = Auth::user();

        // Fetch the team using the provided ID
        $team = Team::with(['lomba', 'users'])->findOrFail($id);

        // Fetch the submission related to the team
        $submission = Submission::where('team_id', $team->id)->first();

        // Fetch the team members related to the team
        $teamMembers = TeamMember::where('team_id', $team->id)->with('user')->get();

        return Inertia::render('Roles/EventAdmin/Rangking/Detailtimpetugas', [
            'userData' => $user,
            'team' => $team,
            'submissions' => $submission,
            'members' => $teamMembers,
        ]);
    }
 
}