<?php

namespace App\Http\Controllers;

use App\Http\Resources\LombaResource;
use App\Models\Lomba;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\StoreLombaRequest;
use Illuminate\Support\Facades\Storage;

class LombaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lombas = LombaResource::collection(Lomba::all());

        return Inertia::render('Roles/Admin/Lomba', [
            'lombas' => $lombas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Roles/Admin/Lomba/Tambahlomba');
     
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(StoreLombaRequest $request)

    {
        // Pastikan request valid
        $validated = $request->validated();
        
   // Simpan file sertifikat ke dalam direktori public
   $sertifikat = $request->file('sertifikat')->storePublicly('sertifikat_files', 'public');

   // Simpan file foto ke dalam direktori public
   $picture = $request->file('picture')->storePublicly('picture_files', 'public');

        // Buat entri baru dalam database dengan file-file yang disimpan
        $lomba = new Lomba();
        $lomba->name = $validated['name'];
        $lomba->description = $validated['description'];
        $lomba->sertifikat = $sertifikat;
        $lomba->picture = $picture;
        $lomba->pj = $validated['pj'];
        $lomba->kontak = $validated['kontak'];
        $lomba->tempat = $validated['tempat'];
        $lomba->biaya_pendaftaran = $validated['biaya_pendaftaran'];
        $lomba->save();
        // Redirect atau kembalikan response sesuai kebutuhan Anda
        return redirect()->route('lomba.index')->with('success', 'Lomba berhasil ditambahkan');
    }


    public function show(Lomba $lomba)
    {
        // Ambil objek Lomba dari parameter metode
        $lomba = Lomba::find($lomba->id);

        // Kirim data lomba beserta URL gambar dan sertifikat ke tampilan
        return Inertia::render('Roles/Admin/Lomba/Detaillomba', [
            'lomba' => $lomba,
            'gambarUrl' => asset("storage/{$lomba->picture}"),
            'sertifikatUrl' => asset("storage/{$lomba->sertifikat}"),
        ]);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lomba $lomba)
    {
        return Inertia::render('Roles/Admin/Lomba/Editlomba', [
            'lomba' => LombaResource::make($lomba),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lomba $lomba)
    {
        
        $validatedData = $request->validate([
            'id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'kontak' => 'required|string|max:255',
            'pj' => 'required|string|max:255',
            'picture' => 'required|image|max:2048',
            'tempat' => 'required|string|max:255',
            'sertifikat' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048',
            'biaya_pendaftaran' => 'required|string|max:255'

        ]);
        $lomba->update($validatedData);

       
        return redirect()->route('lomba.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lomba $lomba)
    {
        $lomba->delete();
        return redirect()->route('lomba.index');
    }
}
