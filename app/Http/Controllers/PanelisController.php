<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Setting;

class PanelisController extends Controller
{
    // public function index()
    // {
    //     return Inertia::render('Roles/Panelis/Dashboardjuri');
    // }
    // public function dashboardjuri()
    // {
    //     return Inertia::render('Roles/Panelis/Dashboardjuri');
    // }

    //RANKING
    public function rangkingjuri()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });  
        return Inertia::render('Roles/Panelis/Rangkingjuri', [
            'settings' => $settings,
        ]);
    }
    public function tabelrangkingjuri()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });  
        return Inertia::render('Roles/Panelis/Rangking/Tabelrangkingjuri', [
            'settings' => $settings,
        ]);
    }
    public function lombajuri()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });  
        return Inertia::render('Roles/Panelis/Lombajuri', [
            'settings' => $settings,
        ]);
    }
    public function tabellomba()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });  
        return Inertia::render('Roles/Panelis/Lomba/Tabellomba', [
            'settings' => $settings,
        ]);
    }
    public function nilai()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });  
        return Inertia::render('Roles/Panelis/Lomba/Nilai', [
            'settings' => $settings,
        ]);
    }
    public function editnilai()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });  
        return Inertia::render('Roles/Panelis/Lomba/Editnilai', [
            'settings' => $settings,
        ]);
    }
    public function timdetailjuri()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });  
        return Inertia::render('Roles/Panelis/Lomba/Timdetailjuri', [
            'settings' => $settings,
        ]);
    }
}