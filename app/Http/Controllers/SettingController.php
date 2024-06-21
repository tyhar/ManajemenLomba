<?php

namespace App\Http\Controllers;

use App\Http\Resources\SettingResource;
use App\Models\Setting;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        return Inertia::render('Roles/Admin/Setting', [
            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'id' => $setting->id,
                    'name' => $setting->name,
                    'judul' => $setting->judul,
                    'sub_judul' => $setting->sub_judul,
                    'judul_des' => $setting->judul_des,
                    'deskripsi' => $setting->deskripsi,
                    'mulai' => $setting->mulai,
                    'berakhir' => $setting->berakhir,
                    'des_pendaftaran' => $setting->des_pendaftaran,
                    'pengumpulan' => $setting->pengumpulan,
                    'des_pengumpulan' => $setting->des_pengumpulan,
                    'pengumuman' => $setting->pengumuman,
                    'des_pengumuman' => $setting->des_pengumuman,
                    'presentasi' => $setting->presentasi,
                    'des_presentasi' => $setting->des_presentasi,
                    'whatsApp' => $setting->whatsApp,
                    'instagram' => $setting->instagram,
                    'email' => $setting->email,
                    'youtube' => $setting->youtube,
                    'logo1' => asset('storage/' . $setting->logo1),
                    'logo2' => asset('storage/' . $setting->logo2),
                    'logo3' => asset('storage/' . $setting->logo3)
                ];
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $settings = Setting::all()->map(function ($setting) {
            return [
                'id' => $setting->id,
                'logo1' => $setting->logo1,
            ];
        });
        return Inertia::render('Roles/Admin/Setting/Tambahsetting', [
            'settings' => $settings,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $logo1 = Request::file('logo1')->store('settings', 'public');
        $logo2 = Request::file('logo2')->store('settings', 'public');
        $logo3 = Request::file('logo3')->store('settings', 'public');

        Setting::create([
            'name' => Request::input('name'),
            'judul' => Request::input('judul'),
            'sub_judul' => Request::input('sub_judul'),
            'judul_des' => Request::input('judul_des'),
            'deskripsi' => Request::input('deskripsi'),
            'mulai' => Request::input('mulai'),
            'berakhir' => Request::input('berakhir'),
            'des_pendaftaran' => Request::input('des_pendaftaran'),
            'pengumpulan' => Request::input('pengumpulan'),
            'des_pengumpulan' => Request::input('des_pengumpulan'),
            'pengumuman' => Request::input('pengumuman'),
            'des_pengumuman' => Request::input('des_pengumuman'),
            'presentasi' => Request::input('presentasi'),
            'des_presentasi' => Request::input('des_presentasi'),
            'whatsApp' => Request::input('whatsApp'),
            'instagram' => Request::input('instagram'),
            'email' => Request::input('email'),
            'youtube' => Request::input('youtube'),
            'logo1' => $logo1,
            'logo2' => $logo2,
            'logo3' => $logo3
        ]);

        return redirect()->route('setting.index');
    }


    public function edit(Setting $setting)
    {
        
        return Inertia::render('Roles/Admin/Setting/Editsetting', [
            'settings' => $setting,
            'logo1' => asset('storage/' . $setting->logo1),
            'logo2' => asset('storage/' . $setting->logo2),
            'logo3' => asset('storage/' . $setting->logo3)
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $logo1 = $setting->logo1;
        if (Request::file('logo1')) {
            Storage::delete('public/' . $setting->logo1);
            $logo1 = Request::file('logo1')->store('settings', 'public');
        }
        $logo2 = $setting->logo2;
        if (Request::file('logo2')) {
            Storage::delete('public/' . $setting->logo2);
            $logo2 = Request::file('logo2')->store('settings', 'public');
        }
        $logo3 = $setting->logo3;
        if (Request::file('logo3')) {
            Storage::delete('public/' . $setting->logo3);
            $logo3 = Request::file('logo3')->store('settings', 'public');
        }

        $setting->update([
            'name' => Request::input('name'),
            'judul' => Request::input('judul'),
            'sub_judul' => Request::input('sub_judul'),
            'judul_des' => Request::input('judul_des'),
            'deskripsi' => Request::input('deskripsi'),
            'mulai' => Request::input('mulai'),
            'berakhir' => Request::input('berakhir'),
            'des_pendaftaran' => Request::input('des_pendaftaran'),
            'pengumpulan' => Request::input('pengumpulan'),
            'des_pengumpulan' => Request::input('des_pengumpulan'),
            'pengumuman' => Request::input('pengumuman'),
            'des_pengumuman' => Request::input('des_pengumuman'),
            'presentasi' => Request::input('presentasi'),
            'des_presentasi' => Request::input('des_presentasi'),
            'whatsApp' => Request::input('whatsApp'),
            'instagram' => Request::input('instagram'),
            'email' => Request::input('email'),
            'youtube' => Request::input('youtube'),
            'logo1' => $logo1,
            'logo2' => $logo2,
            'logo3' => $logo3
        ]);

        return redirect()->route('setting.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        Storage::delete('public/' . $setting->logo1);
        $setting->delete();
        return redirect()->route('setting.index');

        Storage::delete('public/' . $setting->logo2);
        $setting->delete();
        return redirect()->route('setting.index');

        Storage::delete('public/' . $setting->logo3);
        $setting->delete();
        return redirect()->route('setting.index');
    }
}