<?php
namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Models\Team;
use App\Models\User;
use App\Http\Requests\StoreTeam;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamController extends Controller
{
    public function create()
    {
        $lombas = Lomba::all();
        return Inertia::render('Roles/User/Daftar/Datatim', ['lombas' => $lombas]);
    }

    public function store(StoreTeam $request)
    {
        $team = new Team();

        $team->name_team = $request->name_team;
        $team->email = $request->email;
        $team->phone = $request->phone;
        $team->instansi = $request->instansi;
        $team->user_id = auth()->user()->id; // Associate with the authenticated user

        if ($request->hasFile('payment')) {
            $team->payment = $request->file('payment')->storePublicly('payments', 'public');
        }

        $team->save();

        if ($request->has('SelectedLomba')) {
            $team->lomba()->attach($request->input('SelectedLomba'));
        }

        return redirect()->route('daftarlomba.show');
    }

    public function show($id)
    {
        $team = Team::findOrFail($id);
        Inertia::share('userData', [
            'payment' => $team->payment,
        ]);

        return Inertia::render('Roles/User/Daftar/ImageFilePayment', [
            'UserData' => $team,
        ]);
    }
}
