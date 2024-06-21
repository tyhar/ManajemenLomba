<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use App\Models\Team;
use Inertia\Inertia;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function notifikasipeserta()
    {
        $settings = Setting::all();
        $user = Auth::user();
        
        // Ambil tim yang dimiliki oleh pengguna
        $team = Team::where('user_id', $user->id)->first();
        
        // Ambil semua notifikasi yang belum dibaca terkait dengan pengguna
        $notifikasis = Notifikasi::where('team_id', $team->id)->get();
        
        $team = $user->team()->with('user')->first();

        // If the team exists, count the unread notifications for that team
        $notifCount = null;

        // If the team exists, count the unread notifications for that team
        if ($team) {
            $notifCount = Notifikasi::where('status', 'belum_dibaca')
                                    ->where('team_id', $team->id)
                                    ->count();
        }
        
        return Inertia::render('Roles/User/Notifikasipeserta', [
            'notifikasis' => $notifikasis,
            'notifCount' => $notifCount,
            'settings' => $settings,
            'isVerified' => $team && $team->status === 'verified', // Properti isVerified berdasarkan status tim
        ]);
    }
    
    
    

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'team_id' => 'required|exists:team,id',
            'description' => 'required|string|max:255'
        ]);
    


    
        // Create the notification
        Notifikasi::create([
            'team_id' => $request->team_id,
            'description' => $request->description,
        ]);
    
        // Redirect to the desired route
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

    //     public function markAsRead(Request $request)
    //     {
    //         $user = Auth::user();
    //         $notifikasiId = $request->input('id');
    
    //         // Cari notifikasi berdasarkan ID dan pastikan notifikasi tersebut milik tim pengguna
    //         $notifikasi = Notifikasi::whereHas('team', function($query) use ($user) {
    //             $query->where('user_id', $user->id);
    //         })->where('id', $notifikasiId)->first();
    //   $user = Auth::user();
    //         if ($notifikasi) {
    //             $notifikasi->status = 'sudah_dibaca';
    //             $notifikasi->save();
    
    //             return response()->json(['success' => true]);
    //         }
    
    //         return response()->json(['success' => false], 404);
    //     }

        public function markAllAsRead()
    {
        $user = Auth::user();
        $team = $user->team()->with('user')->first();

        if ($team) {
            Notifikasi::where('status', 'belum_dibaca')
                      ->where('team_id', $team->id)
                      ->update(['status' => 'sudah_dibaca']);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
    
    
    
}
