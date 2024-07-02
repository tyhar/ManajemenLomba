<?php

namespace App\Http\Controllers;

use App\Http\Resources\KriteriaResource;
use App\Http\Resources\BobotResource;
use App\Models\Kriteria;
use App\Models\Bobot;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::all();
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,

        ]);
        $kriteria = KriteriaResource::collection(Kriteria::all());

        return Inertia::render('Roles/Admin/Kriteria', [
            'kriterias' => $kriteria,
            'UserData' => $user,
            'settings' =>$setting,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::all();
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);

        return Inertia::render('Roles/Admin/Kriteria/Tambahkriteria',[
           'UserData' => $user,
           'settings' =>$setting,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi request
        $validatedData = $request->validate([
            'kriteria' => 'required|array',
            'kriteria.*.name_kriteria' => 'required|string',
        ]);
    
        // Simpan kriteria dan bobot
        foreach ($validatedData['kriteria'] as $item) {
            // Simpan kriteria
            $kriteriaModel = new Kriteria();
            $kriteriaModel->name_kriteria = $item['name_kriteria'];
            $kriteriaModel->save();
        }
    
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan');
    }
    

/**
 * Display the specified resource.
 */
public function show($kriteria)
{
    $user = Auth::user();
    Inertia::share('userData', [
        'name' => $user->name,
        'username' => $user->username,
    ]);
    $kriteria = Kriteria::findOrFail($kriteria);

    // Kembalikan tampilan menggunakan Inertia dengan data kriteria
    return Inertia::render('Roles/Admin/Kriteria/Detailkriteria', [
        'kriteria' => $kriteria,
        'UserData' => $user,
    ]);
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $setting = Setting::all();
        $kriteria = Kriteria::findOrFail($id);

        return Inertia::render('Roles/Admin/Kriteria/Editkriteria', [
            'kriterias' => [
                'data' => $kriteria,
            ],
            'userData' => auth()->user(),
            'settings' =>$setting, // Assuming you pass user data to the page props
        ]);
    }

    // Update the kriteria
    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::findOrFail($id);

        $request->validate([
            'name_kriteria' => 'required|string|max:255',
        ]);

        $kriteria->update([
            'name_kriteria' => $request->name_kriteria,
        ]);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui!');
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
