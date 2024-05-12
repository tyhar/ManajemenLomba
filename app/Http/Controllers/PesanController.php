<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Pesan;

class PesanController extends Controller
{
    public function create(Request $request)
    {
        Pesan::create($request->validate([
            'nama' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email'],
            'nomor' => ['required', 'max:50'],
            'pesan' => ['required', 'max:250'],
        ]));

        // Redirect ke rute index pesan setelah berhasil membuat pesan baru
        return redirect()->route('pesan.index');
    }
}
