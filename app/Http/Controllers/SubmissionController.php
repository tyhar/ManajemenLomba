<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function create()
    {
        $submission = Submission::all();
        return Inertia::render('Roles/User/Daftar/Pengumpulankarya', ['submissions' => $submission]);
    }
    public function store(Request $request)
    {
        // Validasi data request yang masuk
        $request->validate([
            'title' => 'required',
            'description' => 'required|string|max:1000',
            'link' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,zip,rar|max:512000',
        ]);
    
        // Mengambil user yang sedang terautentikasi
        $user = Auth::user();
    
        // Asumsikan setiap pengguna hanya memiliki satu tim
        // Jika tidak, Anda perlu menyesuaikan logika ini
        $team = $user->team()->first(); // atau sesuai dengan relasi yang Anda miliki
    
        // Inisialisasi path file sebagai null jika tidak ada file yang diupload
        $filePath = null;
    
        // Cek apakah ada file yang diupload dan simpan file tersebut
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->storePublicly('file_lomba', 'public');
        }
    
        // Buat submission baru dengan data yang diberikan
        Submission::create([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'file' => $filePath,
            'team_id' => $team->id, // Menyertakan team_id dalam data submission
        ]);
    
        // Redirect ke halaman yang diinginkan setelah submission dibuat
        return redirect()->route('submissions.index');
    }
    
}
