<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function show($team_id)
{
    $settings = Setting::all();
    $user = Auth::user();
    $teams = $user->team()->where('id', $team_id)->with(['lomba', 'user'])->first();
    $team = Team::findOrFail($team_id);
    return Inertia::render('Roles/User/Daftar/Datatim', [
        'teams' => [
            'data' => $team,
        ],
        'userData' => $user,
        'teamz' => $teams,
        'settings' => $settings,
    ]);
}

public function store(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'name_team' => 'nullable|string|max:255',
        'email' => 'required|string|email|max:255',
        'phone' => 'required|string|max:15',
        'instansi' => 'required|string|max:255',
        'payment' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Retrieve the authenticated user
    $user = Auth::user();

    // Retrieve the team associated with the authenticated user
    $team = $user->team()->where('id', $id)->first();

    // Check if the team exists
    if (!$team) {
        return redirect()->route('dashboard')->with('error', 'Tim tidak ditemukan');
    }

    // Check if there are changes in data
    $isDataChanged = (
        $team->name_team !== $request->input('name_team') ||
        $team->email !== $request->input('email') ||
        $team->phone !== $request->input('phone') ||
        $team->instansi !== $request->input('instansi') ||
        $request->hasFile('payment')
    );

    if ($isDataChanged) {
        // Delete old payment file if exists
        if ($team->payment && $request->hasFile('payment')) {
            Storage::delete('public/' . $team->payment);
        }

        // Save new data
        $team->name_team = $request->input('name_team');
        $team->email = $request->input('email');
        $team->phone = $request->input('phone');
        $team->instansi = $request->input('instansi');

        if ($request->hasFile('payment')) {
            $path = $request->file('payment')->store('payments', 'public');
            $team->payment = $path;
        }

        $team->save();

        return redirect()->route('datatim.show', $team->id);
    }

    return redirect()->route('dashboard')->with('info', 'Tidak ada perubahan yang disimpan');
}

}