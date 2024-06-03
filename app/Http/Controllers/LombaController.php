<?php

namespace App\Http\Controllers;

use App\Http\Resources\LombaResource;
use App\Models\Lomba;
use App\Models\User;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreLombaRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\KriteriaResource;


class LombaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $lomba = LombaResource::collection(Lomba::all());

        return Inertia::render('Roles/Admin/Lomba', [
            'lombas' => $lomba,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $kriteria = KriteriaResource::collection(Kriteria::all());

        return Inertia::render('Roles/Admin/Lomba/Tambahlomba', [
            'kriteriaz' => $kriteria,
        ]);
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
        $lomba->name_lomba = $validated['name_lomba'];
        $lomba->description = $validated['description'];
        $lomba->sertifikat = $sertifikat;
        $lomba->picture = $picture;
        $lomba->pj = $validated['pj'];
        $lomba->kontak = $validated['kontak'];
        $lomba->tempat = $validated['tempat'];
        $lomba->biaya_pendaftaran = $validated['biaya_pendaftaran'];
        $lomba->save();

        // Simpan kriteria yang dipilih
        if ($request->has('selectedCriteria')) { //has similar to where()
            $lomba->kriteria()->attach($request->input('selectedCriteria'));
        }

        // Redirect atau kembalikan response sesuai kebutuhan Anda
        return redirect()->route('lomba.index')->with('success', 'Lomba berhasil ditambahkan');
    }

    public function show(Lomba $lomba)
    {

        // Ambil objek Lomba dari parameter metode
        $lomba = Lomba::with('kriteria')->find($lomba->id);

        // Buat variabel untuk menyimpan URL gambar dan sertifikat
        $pictureUrl = null;
        $sertifikatUrl = null;

        // Periksa apakah gambar tersedia
        if ($lomba->picture) {
            // Buat path untuk gambar baru
            $picturePath = 'picture_files/' . $lomba->picture;
            // Periksa apakah file gambar baru ada
            if (Storage::exists($picturePath)) {
                // Generate URL untuk gambar baru
                $pictureUrl = asset('storage/' . $picturePath);
            } else {
                // Jika file gambar tidak ditemukan, berikan URL default atau pesan error
                $pictureUrl = asset('default_picture.jpg'); // Ganti dengan URL gambar default yang sesuai
                // Atau berikan pesan error
                // echo "File gambar tidak ditemukan.";
            }
        }

        // Periksa apakah sertifikat tersedia
        if ($lomba->sertifikat) {
            // Buat path untuk sertifikat baru
            $sertifikatPath = 'sertifikat_files/' . $lomba->sertifikat;
            // Periksa apakah file sertifikat baru ada
            if (Storage::exists($sertifikatPath)) {
                // Generate URL untuk sertifikat baru
                $sertifikatUrl = asset('storage/' . $sertifikatPath);
            } else {
                // Jika file sertifikat tidak ditemukan, berikan URL default atau pesan error
                $sertifikatUrl =  asset('default_picture.jpg'); // Jika sertifikat tidak ada, mungkin Anda tidak ingin menampilkan apa pun
                // Atau berikan pesan error
                // echo "File sertifikat tidak ditemukan.";
            }
        }
        // Kirim data lomba beserta URL gambar dan sertifikat ke tampilan
        return Inertia::render('Roles/Admin/Lomba/Detaillomba', [
            'lomba' => $lomba,
            'pictureUrl' => $pictureUrl,
            'sertifikatUrl' => $sertifikatUrl,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lomba $lomba)
    {
        // Mengambil semua kriteria yang tersedia
        $kriteria = KriteriaResource::collection(Kriteria::all());

        // Mengambil ID kriteria yang telah dipilih sebelumnya untuk lomba ini
        // $selectedKriteriaIds = $lomba->kriteria()->pluck('id')->toArray();

        return Inertia::render('Roles/Admin/Lomba/Editlomba', [
            'lombas' => LombaResource::make($lomba),
            'lomba' => $lomba,
            'kriterias' => $kriteria,
            // 'selectedKriteria' => $selectedKriteriaIds,
        ]);
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lomba $lomba)
    {
        $picture = $lomba->picture;
        if ($request->file('picture')) {
            Storage::delete('public/' . $lomba->picture);
            $picture = $request->file('picture')->storePublicly('picture_files', 'public');
        }

        $sertifikat = $lomba->sertifikat;
        if ($request->file('sertifikat')) {
            Storage::delete('public/' . $lomba->sertifikat);
            $sertifikat = $request->file('sertifikat')->storePublicly('sertifikat_files', 'public');
        }

        $lomba->update([
            'name_lomba' => $request->input('name_lomba'),
            'pj' => $request->input('pj'),
            'kontak' => $request->input('kontak'),
            'description' => $request->input('description'),
            'tempat' => $request->input('tempat'),
            'biaya_pendaftaran' => $request->input('biaya_pendaftaran'),
            'picture' => $picture,
            'sertifikat' => $sertifikat,
        ]);
        $lomba->kriteria()->detach();

        if ($request->has('selectedCriteria')) {
            $lomba->kriteria()->attach($request->input('selectedCriteria'));
        }

        return redirect()->route('lomba.index')->with('success', 'Lomba berhasil diupdate');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lomba $lomba)
    {
        // Hapus picture
        Storage::delete('public/' . $lomba->picture);
        //hapus file sertfikat
        Storage::delete('public/' . $lomba->sertifikat);
        $lomba->kriteria()->detach();
        $lomba->user()->detach();
        $lomba->delete();

        return redirect()->route('lomba.index');
    }
}
