<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TeamMemberController extends Controller
{
    public function store(Request $request, $id)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Find the team by ID and get the team ID
        $team = $user->team()->where('id', $id)->first();

        if (!$team) {
            return response()->json([
                'success' => false,
                'message' => 'Team not found'
            ], 404);
        }

        $teamId = $team->id;

        // Validate the request
        $validator = Validator::make($request->all(), [
            'members' => 'required|array',
            'members.*.user_id' => 'required|exists:users,id',
            'members.*.role' => 'required|in:Ketua,Anggota'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $members = $request->members;

        // Remove existing members
        TeamMember::where('team_id', $teamId)->delete();

        // Add new members
        foreach ($members as $member) {
            TeamMember::create([
                'team_id' => $teamId,
                'user_id' => $member['user_id'],
                'role' => $member['role']
            ]);
        }

        return redirect()->route('dashboard');
    }
}
