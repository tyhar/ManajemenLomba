<?php

namespace App\Http\Controllers;

use App\Http\Resources\LombaResource;
use App\Http\Resources\KriteriaLombaResource;
use App\Http\Resources\KriteriaResource;
use App\Models\Lomba;
use App\Models\Kriteria;
use App\Models\KriteriaLomba;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Message;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreLombaRequest;
use Illuminate\Support\Facades\Storage;


class LombaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unreadCount = Message::where('status', 'belum_dibaca')->count();
        $setting = Setting::all();
        $lomba = LombaResource::collection(Lomba::all());

        return Inertia::render('Roles/Admin/Lomba', [
            'lombas' => $lomba,
            'settings' =>$setting,
            'unreadCount' => $unreadCount
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kriteria = KriteriaResource::collection(Kriteria::all());
        $setting = Setting::all(); 
        return Inertia::render('Roles/Admin/Lomba/Tambahlomba', [
            'kriteriaz' => $kriteria,
            'settings' =>$setting,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLombaRequest $request)
    {
        // Validate the request
        $validated = $request->validated();
        
        // Save the certificate and picture files to the public directory
        $sertifikat = $request->file('sertifikat')->storePublicly('sertifikat_files', 'public');
        $picture = $request->file('picture')->storePublicly('picture_files', 'public');
    
        // Create a new entry in the database with the saved files
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
    
        // Save selected criteria with their respective weights
        if ($request->has('selectedCriteria')) {
            $selectedCriteria = $request->input('selectedCriteria');
            $bobotValues = $request->input('bobot');
    
            foreach ($selectedCriteria as $kriteriaId) {
                KriteriaLomba::create([
                    'lomba_id' => $lomba->id,
                    'kriteria_id' => $kriteriaId,
                    'bobot' => $bobotValues[$kriteriaId] ?? 0,
                ]);
            }
        }
    
        // Redirect or return response as needed
        return redirect()->route('lomba.index')->with('success', 'Lomba berhasil ditambahkan');
    }

    public function show(Lomba $lomba)
    {
        $setting = Setting::all();
        // Ambil objek Lomba dari parameter metode
        $lomba = Lomba::with('kriteria')->find($lomba->id);
      
        // Buat variabel untuk menyimpan URL gambar dan sertifikat
        $pictureUrl = null;
    
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

        // Kirim data lomba beserta URL gambar dan sertifikat ke tampilan
        return Inertia::render('Roles/Admin/Lomba/Detaillomba', [
            'lomba' => $lomba,
            'pictureUrl' => $pictureUrl,
            'settings' =>$setting,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lomba $lomba)
    {
        $setting = Setting::all();
        $kriteria = KriteriaResource::collection(Kriteria::all());
        $lombaCriteria = $lomba->kriteria()->get()->map(function ($criteria) {
            return [
                'id' => $criteria->id,
                'weight' => $criteria->pivot->bobot, // Assuming 'weight' is stored in pivot table
            ];
        });
        return Inertia::render('Roles/Admin/Lomba/Editlomba', [
            'lombas' => LombaResource::make($lomba),    
            'lomba' => $lomba,
            'kriterias' => $kriteria,
            'settings' =>$setting,
            'lombaCriteria' => $lombaCriteria,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lomba $lomba)
    {
        // Validate request data
        $request->validate([
            'name_lomba' => 'required|string|max:255',
            'pj' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tempat' => 'required|string|max:255',
            'biaya_pendaftaran' => 'required|numeric',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'sertifikat' => 'nullable|mimes:pdf|max:2048',
            'selectedCriteria' => 'nullable|array',
            'selectedCriteria.*' => 'exists:kriterias,id',
            'bobot' => 'nullable|array',
            'bobot.*' => 'integer|min:0|max:100',
        ]);
    
        // Handle picture upload
        $picture = $lomba->picture;
        if ($request->file('picture')) {
            Storage::delete('public/' . $lomba->picture);
            $picture = $request->file('picture')->store('picture_files', 'public');
        }
    
        // Handle sertifikat upload
        $sertifikat = $lomba->sertifikat;
        if ($request->file('sertifikat')) {
            Storage::delete('public/' . $lomba->sertifikat);
            $sertifikat = $request->file('sertifikat')->store('sertifikat_files', 'public');
        }
    
        // Update lomba data
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
    
        // Update kriteria and their respective bobot
        $lomba->kriteria()->detach();
    
        if ($request->has('selectedCriteria')) {
            $selectedCriteria = $request->input('selectedCriteria');
            $bobotValues = $request->input('bobot');
    
            foreach ($selectedCriteria as $kriteriaId) {
                $lomba->kriteria()->attach($kriteriaId, [
                    'bobot' => $bobotValues[$kriteriaId] ?? 0,
                ]);
            }
        }
    
        return redirect()->route('lomba.index')->with('success', 'Lomba berhasil diupdate');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lomba $lomba)
    {
        // Hapus picture
        Storage::delete('public/'. $lomba->picture);
        // Hapus file sertifikat
        Storage::delete('public/'. $lomba->sertifikat);
        
        $lomba->kriteria()->detach();
        $lomba->user()->detach();
        $lomba->delete();

        return redirect()->route('lomba.index');
    }
}
