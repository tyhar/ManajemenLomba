<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use App\Models\Team;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegLombaController extends Controller
{
    public function index()
    {
        $team = Team::with('lomba')->first();
        $user = Auth::user();
        $users = User::all();

        $submission = Submission::first(); 
        Inertia::share('submission', [
            'title' => $submission->title,
                'description' => $submission->description,
                'link' => $submission->link,
        ]);
        return Inertia::render('Roles/User/Daftarlomba', [
            'userData' => $user,
            'users' => $users,
            'team' => $team,
            'submission' => $submission,
        ]);
    }
    public function show($id)
    {
        // Fetch the submission record from the database
        $submission = Submission::findOrFail($id);
    
        // Share user data with Inertia
        Inertia::share('userData', [
            'file' => $submission->file,
        ]);
    
        // Return the Inertia view with the image URL
        return Inertia::render('Roles/User/Daftar/ImageFileSubmission', [
            'UserData' => $submission,
        ]);

    }
    
  




    public function store()
    {
        return redirect()->route('daftarlomba.index')->with('success', 'Profil berhasil diupdate');
    }
}
