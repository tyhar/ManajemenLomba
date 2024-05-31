<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TeamMemberController extends Controller
{
    public function store(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Ensure the user is associated with a team
        if (!$user->team) {
            return response()->json([
                'success' => false,
                'message' => 'User is not associated with any team'
            ], 400);
        }

        $teamId = $user->team->id;

        // Validate the request
        $validator = Validator::make($request->all(), [
            'members' => 'required|array',
            'members.*.user_id' => 'required|exists:users,id',
            'members.*.role' => 'required|in:ketua,member'
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

        return redirect()->route('daftarlomba.index');
    }
}
