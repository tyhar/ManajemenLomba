<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna terotentikasi
        if (!Auth::check()) {
            return $this->redirectToLogin();
        }

        // Berbagi data pengguna dengan Inertia
        $this->shareUserData();

        // Dapatkan peran pengguna
        $userRole = Auth::user()->role;

        // Periksa peran pengguna dan arahkan sesuai kebutuhan
        switch ($userRole) {
            case 1:
                return $next($request); // Admin
            case 2:
                return redirect()->route('eventadmin'); // Event Admin
            case 3:
                return redirect()->route('dashboard'); // User
            case 4:
                return redirect()->route('panelis'); // Panelis
            default:
                return $this->handleUnknownRole(); // Peran tidak dikenali
        }
    }

    private function redirectToLogin(): RedirectResponse
    {
        return redirect()->route('login');
    }

    private function shareUserData(): void
    {
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);
    }

    private function handleUnknownRole(): RedirectResponse
    {
        // Tindakan apa yang harus diambil jika peran pengguna tidak dikenali?
        // Misalnya, alihkan ke halaman default atau tampilkan pesan kesalahan.
        // Sebagai contoh, saya hanya akan mengarahkan ke halaman dashboard.
        return redirect()->route('dashboard');
    }
}

