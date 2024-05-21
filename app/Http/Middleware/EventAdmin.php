<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;


class EventAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna terotentikasi
        if (!Auth::check()) {
            return $this->redirectToLogin();
        }

        // Dapatkan peran pengguna
        $userRole = Auth::user()->role;

        // Berbagi data pengguna dengan Inertia
        $this->shareUserData();

        // Periksa peran pengguna dan arahkan sesuai kebutuhan
        switch ($userRole) {
            case 1:
                return redirect()->route('admin');
            case 2:
                return $next($request);
            case 3:
                return redirect()->route('dashboard');
            case 4:
                return redirect()->route('panelis');
            default:
                return $this->handleUnknownRole();
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
