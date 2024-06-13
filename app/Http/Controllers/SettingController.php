<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
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

        $unreadCount = Message::where('status', 'belum_dibaca')->count();

        return Inertia::render('Roles/Admin/Setting', [
            'settings' => Setting::all()->map(function($setting) {
                return [
                    'id' => $setting->id,
                    'name' => $setting->name,
                    'judul' => $setting->judul,
                    'sub_judul' => $setting->sub_judul,
                    'judul_des' => $setting->judul_des,
                    'deskripsi' => $setting->deskripsi,
                    'mulai' => $setting->mulai,
                    'berakhir' => $setting->berakhir,
                    'logo1' => asset('storage/'.$setting->logo1),
                    'logo2' => asset('storage/'.$setting->logo2),
                    'logo3' => asset('storage/'.$setting->logo3)
                ];
                

            }),
            'unreadCount' => $unreadCount,


        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return Inertia::render('Roles/Admin/Setting/Tambahsetting');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $logo1 = Request::file('logo1')->store('settings','public');
        $logo2 = Request::file('logo2')->store('settings','public');
        $logo3 = Request::file('logo3')->store('settings','public');
    
        Setting::create([
            'name' => Request::input('name'),
            'judul' => Request::input('judul'),
            'sub_judul' => Request::input('sub_judul'),
            'judul_des' => Request::input('judul_des'),
            'deskripsi' => Request::input('deskripsi'),
            'mulai' => Request::input('mulai'),
            'berakhir' => Request::input('berakhir'),
            'logo1' => $logo1,
            'logo2' => $logo2,
            'logo3' => $logo3
        ]);

        return redirect()->route('setting.index');
    }


    public function edit(Setting $setting)
    {

        $settingz = Setting::all();
        return Inertia::render('Roles/Admin/Setting/Editsetting', [
            'settingsz' => $settingz,
            'settings' => $setting,
            'logo1' => asset('storage/'.$setting->logo1),
            'logo2' => asset('storage/'.$setting->logo2),
            'logo3' => asset('storage/'.$setting->logo3)
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $logo1 = $setting->logo1;
        if(Request::file('logo1')){
            Storage::delete('public/'.$setting->logo1);
            $logo1 = Request::file('logo1')->store('settings','public');
        }
        $logo2 = $setting->logo2;
        if(Request::file('logo2')){
            Storage::delete('public/'.$setting->logo2);
            $logo2 = Request::file('logo2')->store('settings','public');
        }
        $logo3 = $setting->logo3;
        if(Request::file('logo3')){
            Storage::delete('public/'.$setting->logo3);
            $logo3 = Request::file('logo3')->store('settings','public');
        }

        $setting->update([
            'name' => Request::input('name'),
            'judul' => Request::input('judul'),
            'sub_judul' => Request::input('sub_judul'),
            'judul_des' => Request::input('judul_des'),
            'deskripsi' => Request::input('deskripsi'),
            'mulai' => Request::input('mulai'),
            'berakhir' => Request::input('berakhir'),
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
        Storage::delete('public/'.$setting->logo1);
        $setting->delete();
        return redirect()->route('setting.index');

        Storage::delete('public/'.$setting->logo2);
        $setting->delete();
        return redirect()->route('setting.index');

        Storage::delete('public/'.$setting->logo3);
        $setting->delete();
        return redirect()->route('setting.index');
    }
}
