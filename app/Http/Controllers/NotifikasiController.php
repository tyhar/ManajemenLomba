<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use App\Models\Team;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function notifikasipeserta()
    {
        $user = Auth::user();

        // Ambil tim yang dimiliki oleh pengguna
        $team = Team::where('user_id', $user->id)->first();

        // Ambil semua notifikasi yang terkait dengan pengguna
        $notifikasis = Notifikasi::whereHas('team', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return Inertia::render('Roles/User/Notifikasipeserta', [
            'notifikasis' => $notifikasis,
            'isVerified' => $team && $team->status === 'verified', // Properti isVerified berdasarkan status tim
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:team,id',
            'description' => 'required|string|max:255'
        ]);

        Notifikasi::create([
            'team_id' => $request->team_id,
            'description' => $request->description,
        ]);

        return redirect()->route('timpetugas.index');
    }


    public function notifikasiByTeamId()
    {
        // Periksa apakah pengguna terotentikasi
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $user = Auth::user();
    
        // Menghitung jumlah notifikasi berdasarkan ID tim yang terkait dengan pengguna
        $notifCount = Notifikasi::whereHas('team', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();
    
        return response()->json(['notifCount' => $notifCount]);
    }
    
}
