<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User; // Menggunakan singular "User" sebagai model
use Illuminate\Support\Facades\Auth;
use Exception;

class LoginWithGoogleController extends Controller
{
    public function googlepage()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Ambil data pengguna dari Google
            $googleUser = Socialite::driver('google')->user();

            // Cari pengguna berdasarkan Google ID
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                // Jika pengguna sudah ada, login dan arahkan ke halaman yang dimaksud
                Auth::login($user);
                return redirect()->intended('dashboard');
            } else {
                // Jika pengguna baru, buat entri pengguna baru di database
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => encrypt('123456dummy')
                ]);

                // Login pengguna baru dan arahkan ke halaman yang dimaksud
                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
        } catch (Exception $e) {
            // Tangani kesalahan jika terjadi
            dd($e->getMessage());
        }
    }
}
