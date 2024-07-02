<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Models\Team;
use App\Models\Lomba;
use App\Models\UserStatus;

class OverviewController extends Controller
{
    public function store(Request $request)
    {
        // Validasi request untuk memastikan 'lomba_id' ada dan valid
        $request->validate([
            'lomba_id' => 'required|exists:lombas,id',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil data lomba berdasarkan 'lomba_id' dari request
        $lomba = Lomba::findOrFail($request->lomba_id);

        try {
            // Buat tim baru dan asosiasikan dengan user dan lomba
            $team = new Team([
                'name_team' => null, // Ambil nama tim dari nama user yang login
                'email' => null, // Ambil email dari user yang login
                'phone' => $user->phone, // Ambil nomor telepon dari user yang login
                'instansi' => $user->instansi, // Ambil instansi dari user yang login
                'payment' => null, // Set payment ke null
                'status' => 'unverified', // Set status ke unverified
            ]);

            // Asosiasikan tim dengan lomba dan user
            $team->lomba()->associate($lomba);
            $team->user()->associate($user);

            // Simpan tim
            $team->save();

            // Buat UserStatus baru untuk ketua tim dan set 'status_ketua_team' menjadi 'terdaftar'
            $userStatus = new UserStatus([
                'user_id' => $user->id,
                'status_ketua_team' => 'terdaftar',
                'lomba_id' => $lomba->id,
            ]);

            // Simpan UserStatus
            $userStatus->save();

            // Redirect ke rute 'daftarlomba.show' dengan lomba_id
            return redirect()->route('daftarlomba.show', $request->lomba_id);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Redirect ke rute 'daftarlomba.show' jika terjadi duplikasi
                return redirect()->route('dashboard');
            }
            // Tangani exception lainnya
            return back()->withErrors(['msg' => 'Gagal menyimpan data.']);
        }
    }
}
