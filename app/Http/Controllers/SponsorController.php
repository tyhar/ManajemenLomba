<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsor;
use Inertia\Inertia;

class SponsorController extends Controller
{
    public function show()
    {

    $sponsors = Sponsor::all();

        // Kembalikan pesan-pesan sebagai respons menggunakan Inertia
        return Inertia::render('Roles/Admin/Sponsor', ['sponsors' => $sponsors]);
    }
    public function create()
    {
      return Inertia::render('Roles/Admin/Sponsor/Tambahsponsor');
    }
    public function edit(Sponsors $sponsors)
    {
        return Inertia::render('Roles/Admin/Pesan', ['sponsors' => $sponsors, 'isUpdating' => true]);
    }
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }
}
