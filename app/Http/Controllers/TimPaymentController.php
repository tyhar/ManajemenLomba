<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Team;

class TimPaymentController extends Controller
{
    public function show($id)
    {
        $team = Team::findOrFail($id);
        Inertia::share('userData', [
            'payment' => $team->payment,
        ]);

        return Inertia::render('Roles/User/Daftar/ImageFilePayment', [
            'UserData' => $team,
        ]);
    }
}
