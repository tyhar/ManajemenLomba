<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\SettingEvent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreSettingRequest;

class SettingEventController extends Controller
{
    public function index()
    {
        return Inertia::render('Roles/Admin/Setting');
    }
    public function create()
    {
        return Inertia::render('Roles/Admin/Setting/Tambahsetting');
    }
    public function store(StoreSettingRequest $request)
    {
        $validated = $request->validated();

        // Simpan file logo ke dalam direktori public
        $logo1 = $request->file('logo1')->storePublicly('logo1', 'public');
        $logo2 = $request->file('logo2')->storePublicly('logo2', 'public');
        $logo3 = $request->file('logo3')->storePublicly('logo3', 'public');

        // Buat entri baru dalam database dengan file-file yang disimpan
        $setting = new SettingEvent();
        $setting->name_event = $validated['name_event'];
        $setting->title = $validated['title'];
        $setting->logo1 = $logo1;
        $setting->logo2 = $logo2;
        $setting->logo3 = $logo3;
        $setting->sub_title = $validated['sub_title'];
        $setting->date_start = $validated['date_start'];
        $setting->date_end = $validated['date_end'];
        $setting->title_description = $validated['title_description'];
        $setting->description = $validated['description'];
        $setting->save();
        return redirect()->route('setting.index')->with('success', 'Event berhasil ditambahkan');
    }


    public function edit()
    {
        return Inertia::render('Roles/Admin/Setting/Editsetting');
    }
    public function update()
    {




        return redirect()->route('setting.index')->with('success', 'Event berhasil ditambahkan');
    }

}