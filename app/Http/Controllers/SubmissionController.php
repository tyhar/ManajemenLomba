<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use Inertia\Inertia;

class SubmissionController extends Controller
{
    public function create()
    {
        $submission = Submission::all();
        return Inertia::render('Roles/User/Daftar/Pengumpulankarya', ['submissions' => $submission]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|string|max:1000',
            'link' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,zip,rar|max:512000',
        ]);

        $filePath = $request->file('file')->storePublicly('file_lomba', 'public');

        Submission::create([
            'title' =>  $request->title,
            'description' =>  $request->description,
            'link' =>  $request->link,
            'file' =>   $filePath,
        ]);

        return redirect()->route('daftarlomba.index');
    }
}
