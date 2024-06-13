<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lomba;
use Inertia\Inertia;


class SertifikatLombaController extends Controller
{
    public function show($id)
    {
        $lomba = Lomba::findOrFail($id);
        Inertia::share('userData', [
            'sertifikatlomba' =>  $lomba->sertifikat,
        ]);

        return Inertia::render('Roles/User/Daftar/sertifikatlomba', [
            'UserData' => $lomba,
        ]);
    }
}
