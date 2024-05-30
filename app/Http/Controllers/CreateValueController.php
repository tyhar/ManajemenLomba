<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Kriteria;
use Illuminate\Support\Facades\Auth;

class CreateValueController extends Controller
{
    public function create($lomba_id)
    {
        // Ensure the user is authenticated
        $user = Auth::user();

        // Fetch kriteria related to the user's specific lomba
        $kriterias = Kriteria::whereHas('lombas', function($query) use ($user, $lomba_id) {
            $query->where('lomba_id', $lomba_id)
                  ->whereHas('user', function($query) use ($user) {
                      $query->where('user_id', $user->id);
                  });
        })->get();

        return Inertia::render('Roles/Panelis/Lomba/Nilai', [
            'kriterias' => $kriterias
        ]);
    }
}
