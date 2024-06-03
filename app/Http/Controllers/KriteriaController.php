<?php

namespace App\Http\Controllers;

use App\Http\Resources\KriteriaResource;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);
        $kriteria = KriteriaResource::collection(Kriteria::all());

        return Inertia::render('Roles/Admin/Kriteria', [
            'kriterias' => $kriteria,
            'UserData' => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);

        return Inertia::render('Roles/Admin/Kriteria/Tambahkriteria',[
           'UserData' => $user,
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

        // Simpan kriteria
        foreach ($validatedData['kriteria'] as $kriteria) {
            $kriteriaModel = new Kriteria();
            $kriteriaModel->name_kriteria = $kriteria['name_kriteria'];
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
    public function edit(Kriteria $kriteria)
    {
        return Inertia::render('Roles/Admin/Kriteria/Editkriteria', [
            'kriterias' => KriteriaResource::make($kriteria),
            'kriteria' => $kriteria,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, Kriteria $kriteria)
{
    // Validasi data yang diterima dari permintaan
    $request->validate([
        'name_kriteria' => 'required|string|max:255', // Sesuaikan dengan aturan validasi Anda
        // Tambahkan validasi untuk atribut lain jika diperlukan
    ]);

    // Perbarui kriteria yang sesuai dengan data yang diterima dari permintaan
    $kriteria->update([
        'name_kriteria' => $request->input('name_kriteria'),
        // Tambahkan atribut lain yang ingin diperbarui
    ]);

    // Redirect ke halaman indeks kriteria setelah pembaruan berhasil
    return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui');
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
