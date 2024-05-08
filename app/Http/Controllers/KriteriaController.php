<?php

namespace App\Http\Controllers;

use App\Http\Resources\KriteriaResource;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\KriteriaValue;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriterias = KriteriaResource::collection(Kriteria::all());

        return Inertia::render('Roles/Admin/Kriteria', [
            'kriterias' => $kriterias
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $sponsors = SponsorResource::collection(Sponsor::all());

        return Inertia::render('Roles/Admin/Kriteria/Tambahkriteria');

        // return Inertia::render('Roles/Admin/Sponsor/Tambahsponsor',[
      //      ''sponsors' => $sponsors,'
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'kriteria' => 'required|array',
            'kriteria.*.name_kriteria' => 'required|string|max:255',
        ]);
    
        // Loop through each kriteria and save them
        foreach ($request->kriteria as $kriteriaData) {
            // Simpan data Kriteria
            $kriteria = Kriteria::create($kriteriaData);
    
            // Jika Kriteria berhasil disimpan, tambahkan KriteriaValue jika ada
            if ($kriteria) {
                // Loop through each kriteria value and save them
                if (isset($kriteriaData['values']) && is_array($kriteriaData['values'])) {
                    foreach ($kriteriaData['values'] as $valueData) {
                        // Pastikan KriteriaValue yang disimpan terkait dengan Kriteria yang baru saja dibuat
                        $kriteria->values()->create($valueData);
                    }
                }
            }
        }
    
        // Redirect or return response as needed
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan');
    }
    


/**
 * Display the specified resource.
 */
public function show($kriteria)
{
    $kriteria = Kriteria::findOrFail($kriteria);

    // Kembalikan tampilan menggunakan Inertia dengan data kriteria
    return Inertia::render('Roles/Admin/Kriteria/Detailkriteria', [
        'kriteria' => $kriteria
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
    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete(); 
        
        return redirect()->route('kriteria.index');
    }
    
}
