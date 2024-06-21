<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\KriteriaLomba;
use App\Models\Lomba;
use App\Models\Team;
use App\Models\Reg_Lomba;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class CreateValueController extends Controller
{
    public function create($reg_lomba_id, $team_id, $lomba_id)
    {
        // Ensure the user is authenticated
        $user = Auth::user();
        $regLomba = Reg_Lomba::with('team', 'lomba', 'submission')->findOrFail($reg_lomba_id);
        $team = Team::with(['lomba', 'user'])->findOrFail($team_id);
        $lomba = Lomba::with(['teams'])->findOrFail( $lomba_id);
        $kriterias = KriteriaLomba::with(['kriteria'])
            ->whereHas('kriteria', function($query) use ($user, $lomba_id) {
                $query->where('lomba_id', $lomba_id);
            })->get();

        $settings = Setting::all();

        return Inertia::render('Roles/Panelis/Lomba/Nilai', [
            'kriterias' => $kriterias,
            'userData' => $user,
            'reg_lombas' => $regLomba,
            'teams' => $team,
            'lombas' => $lomba,
            'settings' => $settings,
        ]);
    }
    }
    