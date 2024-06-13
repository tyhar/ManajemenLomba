<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Submission;

class TimSubmissionController extends Controller
{
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
}
