<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Submission;

class TimSuratController extends Controller
{
    public function show($id)
    {
        $submission = Submission::findOrFail($id);
        Inertia::share('userData', [
            'surat' =>  $submission->surat,
        ]);

        return Inertia::render('Roles/User/Daftar/surat', [
            'UserData' => $submission,
        ]);
    }
}
