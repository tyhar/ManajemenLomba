<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Setting;
use App\Models\Notifikasi;

class ProfilePesertaController extends Controller
{
    public function create()
    {
        $settings = Setting::all();
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
            'nik' => $user->nik,
            'instansi' => $user->instansi,
            'phone' => $user->phone,
            'photo' => $user->photo,
        ]);
        
        $notifCount = null;
    if ($user) {
        $notifCount = Notifikasi::where('status', 'belum_dibaca')
            ->where('user_id', $user->id)
            ->count();
    }

        return Inertia::render('Roles/User/Profilpeserta', [
            'UserData' => $user,
            'notifCount' => $notifCount,
            'settings' => $settings,
            
        ]);
        
    }




    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:15',
            'instansi' => 'nullable|string|max:255',
            'nik' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Check if there are changes in data
        $isDataChanged = false;
        if ($user->name != $request->input('name') ||
            $user->username != $request->input('username') ||
            $user->email != $request->input('email') ||
            $user->phone != $request->input('phone') ||
            $user->instansi != $request->input('instansi') ||
            $user->nik != $request->input('nik') ||
            $request->hasFile('photo')) {
            $isDataChanged = true;
        }
        
        if ($isDataChanged) {
            // Hapus data lama yang tidak lagi diperlukan
            // Misalnya, hapus foto lama jika ada
            if ($user->photo) {
                Storage::delete('public/'. $user->photo);
            }
        
            // Simpan data baru
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->instansi = $request->input('instansi');
            $user->nik = $request->input('nik');
        
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->storePublicly('photo_peserta', 'public');
                $user->photo = $path;
            }
        }
        
        $user->save();
        
        return redirect()->route('profilpeserta.create')->with('success', 'Profil berhasil diupdate');
        
    }
}
