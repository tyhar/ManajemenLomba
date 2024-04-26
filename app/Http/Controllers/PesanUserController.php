<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesan;
use Inertia\Inertia;

class PesanUserController extends Controller
{   
    public function index()
    {

        
        // Ambil pesan-pesan dari database
        $pesans = Pesan::all();

        // Kembalikan pesan-pesan sebagai respons menggunakan Inertia
        return Inertia::render('Roles/Admin/Pesan', ['pesans' => $pesans]);
    }

    public function updateStatus(Request $request, Pesan $pesan)
    {
        // Validasi request jika diperlukan
        $request->validate([
            'status' => 'required|in:read,unread', // Sesuaikan dengan aturan validasi yang sesuai
        ]);

        // Perbarui status pesan
        $pesan->status = $request->status;
        $pesan->save();

        // Redirect atau kembalikan respons sesuai kebutuhan aplikasi Anda
        return redirect()->back()->with('success', 'Status pesan berhasil diperbarui.');
    }
}
