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
use App\Http\Resources\TeamResource;
use App\Models\Setting;


class TimPetugasController extends Controller
{
    public function index()
    {
        $teams = Team::with('lomba')->get();
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });   

        return Inertia::render('Roles/EventAdmin/Timpetugas', [
            'teams' => TeamResource::collection($teams),
            'settings' => $settings
        ]);
        
    }
 public function show($id)
    {
        $user = Auth::user();

        // Fetch the team using the provided ID
        $team = Team::with(['lomba', 'users'])->findOrFail($id);

        // Fetch the submission related to the team
        $submission = Submission::where('team_id', $team->id)->first();

        // Fetch the team members related to the team
        $teamMembers = TeamMember::where('team_id', $team->id)->with('user')->get();

        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });   

        return Inertia::render('Roles/EventAdmin/Tim/Timdetail', [
            'userData' => $user,
            'team' => $team,
            'submissions' => $submission,
            'members' => $teamMembers,
            'settings' => $settings
        ]);
    }
    public function updateStatus(Request $request, $id)
{
    // Validate the incoming request
    $request->validate([
        'status' => 'required|string'
    ]);

    // Find the team by ID
    $team = Team::findOrFail($id);

    // Update the team status
    $team->status = $request->status;
    $team->save();

    return response()->json(['message' => 'Status updated successfully'], 200);
}

}
