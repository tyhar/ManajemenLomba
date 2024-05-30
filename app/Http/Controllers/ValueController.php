<?php

namespace App\Http\Controllers;

use App\Models\Value;
use App\Models\User;
use App\Models\Lomba;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\Submission;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ValueResource;
use App\Http\Resources\KriteriaResource;

class ValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {   
    //     $kriterias = Kriteria::all();

    //     return Inertia::render('Roles/Panelis/Lomba/Nilai', [
    //         'kriterias' => $kriterias
    //     ]);
    // }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Temukan pengguna yang sedang login
        $user = User::find(Auth::id());

        // Validasi data yang diterima
        $data = $request->validate([
            '*.kriteria_id' => 'required|exists:kriterias,id',
            '*.value_count' => 'required|string',
        ]);

        // Iterasi melalui setiap item dalam data
        foreach ($data as $item) {
            // Buat instance baru dari model Value dan isi dengan data
            $value = new Value([
                'kriteria_id' => $item['kriteria_id'],
                'value_count' => $item['value_count'],
            ]);

            // Asosiasikan nilai dengan pengguna
            $value->user()->associate($user);

            // Simpan instance nilai
            $value->save();
        }

        // Arahkan kembali ke rute yang sesuai setelah penyimpanan berhasil
        return redirect()->route('lombajuri.index')->with('success', 'Nilai berhasil disimpan');
    }


    /**
     * Display the specified resource.
     */

    public function show($lomba_id)
    {
        $user = Auth::user();

        // Fetch the team using the provided ID
        $team = Team::with(['lomba', 'users'])->findOrFail($lomba_id);

        // Fetch the submission related to the team
        $submission = Submission::where('team_id', $team->id)->first();

        // Fetch the team members related to the team
        $teamMembers = TeamMember::where('team_id', $team->id)->with('user')->get();

        return Inertia::render('Roles/Panelis/Lomba/Timdetailjuri', [
            'userData' => $user,
            'team' => $team,
            'submissions' => $submission,
            'members' => $teamMembers,
        ]);
    }








    /**
     * Show the form for editing the specified resource.
     */
    public function edit($lomba_id)
    {
        $user = Auth::user();

        // Fetch the Lomba instance
        $lomba = Lomba::findOrFail($lomba_id);

        // Fetch all kriterias related to the lomba and user
        $kriterias = Kriteria::whereHas('lombas', function ($query) use ($user, $lomba) {
            $query->where('lomba_id', $lomba->id);

        })->get();

        $values = Value::where('user_id', $lomba_id)->get()->pluck('value_count', 'kriteria_id');


        // Fetch authenticated user data
        $userData = $user;

        return inertia('Roles/Panelis/Lomba/Editnilai', [
            'kriterias' => $kriterias,
            'userData' => $userData,
            'userValues' => $values
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function updateValueCount(Request $request)
    {
        // Validate the request data
        $request->validate([
            'value_count' => 'required|array',
            'value_count.*' => 'integer',
        ]);

        // Define the specific user_id
        $userId = 14; // Replace with the specific user_id you want to update

        // Update the value_count for the specific user_id
        foreach ($request->input('value_count') as $kriteriaId => $valueCount) {
            Value::updateOrCreate(
                ['user_id' => $userId, 'kriteria_id' => $kriteriaId],
                ['value_count' => $valueCount]
            );
        }

        return redirect()->route('lombajuri.index')->with('success', 'Nilai berhasil disimpan');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kriteria)
    {

        $kriteria = Kriteria::findOrFail($kriteria);
        $kriteria->delete();

        return redirect()->route('kriteria.index');
    }

}