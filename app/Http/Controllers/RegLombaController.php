<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\Lomba;
use App\Models\Reg_Lomba;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Setting;

class RegLombaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $users = User::where('role', 3)->get();
        

        // Mengambil tim yang terkait dengan user yang sedang diautentikasi
        $team = $user->team()->with(['lomba', 'users'])->first();

        $submission = null;
        if ($team) {
            $submission = Submission::where('team_id', $team->id)->first();
        }

        // Get team members if the user has a team
        $teamMembers = $team ? TeamMember::where('team_id', $team->id)->get() : [];

        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });  

        return Inertia::render('Roles/User/Daftarlomba', [
            'userData' => $user,
            'users' => $users,
            'team' => $team,
            'submissions' => $submission,
            'members' => $teamMembers,
            'settings' => $settings, 
        ]);
    }


    public function store(Request $request)
    {
        try {
            // Find user
            $user = User::find(Auth::id());
    
            // Find team
            $team = Team::findOrFail($request->team_id);
    
            // Find team members
            $teamMembers = TeamMember::whereIn('id', $request->team_member_id)->get();
    
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
    
            // Attach team members
            $regLomba->teamMembers()->attach($teamMembers);
    
            return Redirect::route('daftarlomba.index')->with('success', 'Successfully registered for competition.');
        } catch (\Exception $e) {
            // Handle any errors that occur during save
            return Redirect::back()->with('error', 'Failed to register for competition: ' . $e->getMessage());
        }
    }
    
    
}
