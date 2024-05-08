<?php

namespace App\Http\Controllers;

use App\Http\Resources\SponsorResource;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sponsors = SponsorResource::collection(Sponsor::all());

        return Inertia::render('Roles/Admin/Sponsor', [
            'sponsors' => $sponsors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $sponsors = SponsorResource::collection(Sponsor::all());

        return Inertia::render('Roles/Admin/Sponsor/Tambahsponsor');

        // return Inertia::render('Roles/Admin/Sponsor/Tambahsponsor',[
      //      'sponsors' => $sponsors,
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|max:2048', // Memastikan logo adalah file gambar
            'link_file' => 'required|string|max:255'
        ]);
        // Mengunggah file logo ke penyimpanan publik
        $logoPath = $request->file('logo')->storePublicly('logo_files', 'public');
    
        // Membuat entitas Sponsor menggunakan data yang divalidasi
        $sponsor = new Sponsor([
            'name' => $validated['name'],
            'logo' => $logoPath,
            'link_file' => $validated['link_file']
        ]);
        // Menyimpan entitas Sponsor ke dalam database
        $sponsor->save();
    
        // Redirect ke halaman index sponsor setelah berhasil menyimpan
        return redirect()->route('sponsor.index');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Sponsor $sponsor)
    {
        $sponsor = Sponsor::find($sponsor->id);

        $logoUrl = null;
        if ($sponsor->logo) {
            // Buat path untuk gambar baru
            $logoPath = 'logo_files/' . $sponsor->logo;
            // Periksa apakah file gambar baru ada
            if (Storage::exists($logoPath)) {
                // Generate URL untuk gambar baru
                $logoUrl = asset('storage/' . $logoPath);
            } else {
                // Jika file gambar tidak ditemukan, berikan URL default atau pesan error
                $logoUrl = asset('default_picture.jpg'); // Ganti dengan URL gambar default yang sesuai
                // Atau berikan pesan error
                // echo "File gambar tidak ditemukan.";
            }
        }
        return Inertia::render('Roles/Admin/Sponsor/Detailsponsor', [
            'sponsor' => $sponsor,
            'logoUrl' => $logoUrl
        ]);
    }
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsor $sponsor)
    {
        return Inertia::render('Roles/Admin/Sponsor/Editsponsor', [
            'sponsors' => SponsorResource::make($sponsor),
            'sponsor' => $sponsor
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sponsor $sponsor)
    {

        $logo = $sponsor->logo;
        if ($request->file('logo')) {
            Storage::delete('public/'. $sponsor->logo);
            $logo = $request->file('logo')->storePublicly('logo_files', 'public');
        }
        $sponsor->update([
            'name' => $request->input('name'),
            'link_file' => $request->input('link_file'),
            'logo' => $logo,

        ]);

        return redirect()->route('sponsor.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {

        Storage::delete('public/'. $sponsor->logo);
        $sponsor->delete();
        return redirect()->route('sponsor.index');
    }
}
