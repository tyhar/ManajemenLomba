<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Lomba;
use App\Models\User;
use App\Models\Setting;
// use Illuminate\Http\Request;
// use App\Http\Requests\ProfileUpdateRequest;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Redirect;
// use Inertia\Response;

class UserController extends Controller
{
    public function index()
    {

       $lomba = Lomba::all();
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });   
        return Inertia::render('Roles/User/Dashboard', [
            'UserData' => $user,
            'lombas' => $lomba,
            'settings' => $settings, 
        ]);
        
    }

    public function overviewpeserta()
    {
        return Inertia::render('Roles/User/Overviewpeserta');
    }
    public function show($id)
    {

        $lomba = Lomba::findOrFail($id);
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });           
        return Inertia::render('Roles/User/Detailpeserta', [
            'DataUser' => $user,
            'lombax' => $lomba,
            'settings' => $settings, 
        ]);
    }
    public function profilpeserta()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });   
        return Inertia::render('Roles/User/Profilpeserta', [
            'settings' => $settings, 
        ]);
    }
    public function notifikasipeserta()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });   
        return Inertia::render('Roles/User/Notifikasipeserta', [
            'settings' => $settings, 
        ]);
    }
    public function reportpeserta()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });   
        return Inertia::render('Roles/User/Reportpeserta', [
            'settings' => $settings, 
        ]);
    }
    public function detailtimreport()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });   
        return Inertia::render('Roles/User/Report/Detailtimreport', [
            'settings' => $settings, 
        ]);
    }
    public function daftarlomba()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });   
        return Inertia::render('Roles/User/Daftarlomba', [
            'settings' => $settings, 
        ]);
    }
    public function datatim()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });   
        return Inertia::render('Roles/User/Daftar/Datatim', [
            'settings' => $settings, 
        ]);
    }
    public function anggotatim()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });   
        return Inertia::render('Roles/User/Daftar/Anggotatim', [
            'settings' => $settings, 
        ]);
    }
    public function pengumpulankarya()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });   
        return Inertia::render('Roles/User/Daftar/Pengumpulankarya', [
            'settings' => $settings, 
        ]);
    }




    
}
