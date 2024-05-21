<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use App\Models\Team;
use App\Models\Lomba;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegLombaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $users = User::all();
        
        // Mengambil tim yang terkait dengan user yang sedang diautentikasi
        $team = $user->team()->with(['lomba', 'users'])->first();
    
        $submission = null;
        if ($team) {
            $submission = Submission::where('team_id', $team->id)->first();
        }
    
        return Inertia::render('Roles/User/Daftarlomba', [
            'userData' => $user,
            'users' => $users,
            'team' => $team,
            'submissions' => $submission,
        ]);
    }
    

    public function show($id)
    {
        // Fetch the submission record from the database
        $submission = Submission::findOrFail($id);
        
        // Return the Inertia view with the image URL
        return Inertia::render('Roles/User/Daftar/ImageFileSubmission', [
            'UserData' => [
                'file' => $submission->file,
            ],
        ]);
    }

    public function store()
    {
        //
    }
}
