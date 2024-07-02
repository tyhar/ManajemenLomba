<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\Setting;
use App\Models\Notifikasi;
use App\Models\UserStatus;
use App\Models\Lomba;
use App\Models\Reg_Lomba;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RegLombaController extends Controller
{
    public function show($lomba_id)
{
    $notifCount = Notifikasi::where('status', 'belum_dibaca')->count();
    $settings = Setting::all();
    $user = Auth::user();
    $users = User::where('role', 3)->get();
    

    $team = $user->team()->where('lomba_id', $lomba_id)->with(['lomba', 'user'])->first();

    $submission = null;
    if ($team) {
        // Cari submission berdasarkan lomba_id dan team_id
        $submission = Submission::where('lomba_id', $lomba_id)
                                ->where('team_id', $team->id)
                                ->first();
    }


    // Get team members if the user has a team
    // $teamMembers = $team ? TeamMember::where('team_id', $team->id)->get() : [];

    $members =  TeamMember::where('team_id', $team->id)
    ->with(['user' => function($query) {
        $query->select('id', 'name', 'nik', 'photo', 'instansi');
    }])
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


    return Inertia::render('Roles/User/Daftarlomba', [
        'userData' => $user,
        'users' => $users,
        'team' => $team,
        'submissions' => $submission,
        'members' => $members,
        'settings' => $settings,
        'notifCount' => $notifCount,

    ]);
}

public function store(Request $request)
{
    try {
        // Find user
        $user = User::find(Auth::id());

        // Find team
        $team = Team::findOrFail($request->team_id);

        // Find submission
        $submission = Submission::findOrFail($request->submission_id);

        // Retrieve the first lomba associated with the team
        $lomba = $team->lomba()->firstOrFail();

        // Create a new Reg_Lomba instance
        $regLomba = new Reg_Lomba();
        $regLomba->user()->associate($user);
        $regLomba->team()->associate($team);
        $regLomba->submission()->associate($submission);
        $regLomba->lomba()->associate($lomba);

        // Save the reg_lomba instance
        $regLomba->save();
        // $userStatus = new UserStatus([
        //     'user_id' => $user->id,
        //     'status_ketua_team' => 'sudah_submit',
        //     'lomba_id' => $lomba->id,
        // ]);

        // // Simpan UserStatus
        // $userStatus->save();
   
        return Redirect::route('dashboard')->with('success', 'Successfully registered for competition.');
    } catch (\Exception $e) {
        // Handle any errors that occur during save
        return Redirect::route('dashboard')->with('success', 'Successfully registered for competition.');
    }
}


public function updateStatuskelulusan(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'team_id' => 'required|exists:reg_lombas,team_id',
        'status' => 'required|in:lolos,tidak_lolos,menunggu,terverifikasi',
    ]);

    // Update the status_kelulusan for the specified reg_lomba
    Reg_Lomba::where('team_id', $request->team_id)->update(['status_kelulusan' => $request->status]);

    return response()->json(['message' => 'Status updated successfully.'], 200);
}





    public function updateStatus(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:reg_lombas,id',
            'status' => 'required|string|in:lolos,tidak_lolos,menunggu,terferifikasi',
        ]);

        // Update the status_kelulusan for the specified reg_lombas
        Reg_Lomba::whereIn('id', $request->ids)->update(['status_kelulusan' => $request->status]);

        return response()->json(['message' => 'Status updated successfully.'], 200);
    }



    public function tambahanggota($team_id)
    {
        $settings = Setting::all();
        $user = Auth::user();
        $team = $user->team()->where('id', $team_id)->with(['lomba', 'user'])->first();
        $users = User::where('role', 3)->get();
  
        // Get team members if the user has a team
        $teamMembers = $team ? TeamMember::where('team_id', $team->id)->get() : [];
        return Inertia::render('Roles/User/Daftar/Showmember', [
            'userData' => $user,
            'users' => $users,
            'team' => $team,
            'settings' => $settings,

    
        ]);
    }


    public function updateStatusnilai(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:reg_lombas,id',
            'status' => 'required|string|in:dinilai,sudah_dinilai',
        ]);

        // Update the status_kelulusan for the specified reg_lombas
        Reg_Lomba::whereIn('id', $request->ids)->update(['status' => $request->status]);

        return response()->json(['message' => 'Status updated successfully.'], 200);
    }

    
}
