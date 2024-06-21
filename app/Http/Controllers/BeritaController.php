<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Berita;
use App\Models\Pesan;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class BeritaController extends Controller
{
    //
    //BERITA
    public function tambahberita()
    {
        $setting = Setting::all();
        return Inertia::render('Roles/Admin/Berita/Tambahberita',[
            'settings' =>  $setting,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:225',
            'deskripsi_awal' => 'required|max:225',
            'deskripsi' => 'required',
            'penerbit' => 'required|max:225',
            'tanggal_upload' => 'required|date',
            'images' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/uploads/admin/berita', $imageName);
            $validated['images'] = $imageName;
        }
        $validated['tanggal_upload'] = Carbon::createFromFormat('Y-m-d', $validated['tanggal_upload']);
        Berita::create($validated);
        return Redirect::route('berita.index');
        // return Redirect::route('berita.index')->with('message', 'Created successfully');
    }

    public function berita()
    {
        $unreadCount = Message::where('status', 'belum_dibaca')->count();
        $setting = Setting::all();
        Carbon::setLocale('id');
        return Inertia::render('Roles/Admin/Berita', [

            'beritas' => Berita::all()->map(function ($berita) {
                return [
                    'id' => $berita->id,
                    'judul' => $berita->judul,
                    'deskripsi_awal' => $berita->deskripsi_awal,
                    'penerbit' => $berita->penerbit,
                    'tanggal_upload' => Carbon::parse($berita->tanggal_upload)->translatedFormat('d F Y'),
                ];
            }),

            'settings' =>  $setting,
            'unreadCount' => $unreadCount
        ]);
    }


    public function destroy(Berita $berita)
    {
        if ($berita->images) {
            Storage::delete('public/uploads/admin/berita/' . $berita->images);
        }

        $berita->delete();
        return Redirect::route("berita.index");
        // return Redirect::route("berita.index")->with('message', 'delete succefully');
    }

    public function editberita(Berita $berita)
    {
        $setting = Setting::all();
        return Inertia::render('Roles/Admin/Berita/Editberita', [

            'berita' => $berita,
            'settings' => $setting,
        ]);
    }
    public function update(Request $request, Berita $berita)
    {
        $validations = [
            'form.judul' => 'required|max:225',
            'form.deskripsi_awal' => 'required|max:225',
            'form.deskripsi' => 'required',
            'form.penerbit' => 'required|max:225',
            // 'form.tanggal_upload' => 'required|date'
        ];
        if ($request->filled('form.tanggal_upload')) {
            $validations['form.tanggal_upload'] = 'required|date';
        }

        if ($request->hasFile('form.images')) {
            $validations['form.images'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        $validated = $request->validate($validations);
        if ($request->hasFile('form.images')) {
            // Jika ada file baru yang diunggah, hapus foto lama
            if ($berita->images) {
                Storage::delete('public/uploads/admin/berita/' . $berita->images);
            }
            $image = $request->file('form.images');
            $imageName = $image->getClientOriginalName();
            // Menggunakan hanya nama file sebagai nama yang disimpan
            $imagePath = $request->file('form.images')->storeAs('public/uploads/admin/berita', $imageName);
            $validated['form']['images'] = $imageName;
        } else {
            $validated['form']['images'] = $berita->images;
        }

        $berita->update($validated['form']);
        return Redirect::route('berita.index');
        // return Redirect::route('berita.index')->with('message', 'Update successfully');
    }

    public function detailberita(Berita $berita)
    {
        $setting = Setting::all();
        Carbon::setLocale('id');
        return Inertia::render('Roles/Admin/Berita/Detailberita', [
            'berita' => [
                'id' => $berita->id,
                'judul' => $berita->judul,
                'deskripsi_awal' => $berita->deskripsi_awal,
                'deskripsi' => $berita->deskripsi,
                'penerbit' => $berita->penerbit,
                'tanggal_upload' => Carbon::parse($berita->tanggal_upload)->translatedFormat('d F Y'),
                'images' => $berita->images,
            ],
            'settingsz' => $setting,
        ]);
    }
    public function detail(Request $request, Berita $berita)
    {
        Carbon::setLocale('id');
        return Inertia::render('Utama/Detail', [
            // 'berita' => $berita
            'berita' => [
                'id' => $berita->id,
                'judul' => $berita->judul,
                'penerbit' => $berita->penerbit,
                'deskripsi' => $berita->deskripsi,
                'tanggal_upload' => Carbon::parse($berita->tanggal_upload)->translatedFormat('d F Y'),
                'images' => $berita->images,
            ],
            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'logo1' => asset('storage/' . $setting->logo1),
                ];
            }),
        ]);
    }
}