<?php
namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Setting;
use App\Models\Lomba;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function show($team_id)
    {
        $settings = Setting::all();
        $user = Auth::user();
        $submissions = $user->team()->where('id', $team_id)->with(['lomba', 'user'])->first();
        $submission = Submission::where('team_id', $team_id)->first();
        return Inertia::render('Roles/User/Daftar/Pengumpulankarya', [
            'tim' =>  $submissions,
            'submissions' => $submission,
            'userData' => $user,
            'settings' => $settings,
        ]);
    }

    public function storeOrUpdate(Request $request, $id)
    {
        // Validasi data request yang masuk
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'link' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:zip|max:20480',
            'surat' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $user = Auth::user();
        // Retrieve the team associated with the authenticated user
        $team = $user->team()->where('id', $id)->with('lomba')->first();

        $filePath = null;
        $suratPath = null;
        // Cek apakah ada file yang diupload dan simpan file tersebut
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->storePublicly('file_lomba', 'public');
        }
        if ($request->hasFile('surat')) {
            $suratPath = $request->file('surat')->storePublicly('surat_lomba', 'public');
        }

        // Check if submission already exists
        $submission = Submission::where('team_id', $id)->first();

        if ($submission) {
            // Update existing submission
            $submission->update([
                'title' => $request->title,
                'description' => $request->description,
                'link' => $request->link,
                'file' => $filePath ?? $submission->file,
                'surat' => $suratPath ?? $submission->surat,
            ]);
        } else {
            // Create new submission
            Submission::create([
                'title' => $request->title,
                'description' => $request->description,
                'link' => $request->link,
                'file' => $filePath,
                'surat' => $suratPath,
                'team_id' => $team->id,
                'user_id' => $user->id,
                'lomba_id' => $team->lomba->id, // Menggunakan lomba_id dari relasi team
            ]);
        }

        // Redirect ke halaman yang diinginkan setelah submission dibuat atau diperbarui
        return redirect()->route('dashboard');
    }
}
