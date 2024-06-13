<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\KriteriaLombaBobot;
use Illuminate\Support\Facades\Auth;

class CreateValueController extends Controller
{
    public function create($lomba_id)
    {
        // Ensure the user is authenticated
        $user = Auth::user();

        // Fetch kriteria related to the user's specific lomba with the necessary relationships
        $kriterias = KriteriaLombaBobot::with(['kriteria_bobot.kriteria', 'kriteria_bobot.bobot'])
            ->whereHas('kriteria_bobot', function($query) use ($user, $lomba_id) {
                $query->where('lomba_id', $lomba_id);
            })->get();

        return Inertia::render('Roles/Panelis/Lomba/Nilai', [
            'kriterias' => $kriterias,
            'userData' => $user
        ]);
    }
}
