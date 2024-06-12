<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
// use Illuminate\Http\Request;
// use App\Http\Requests\ProfileUpdateRequest;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
// use Illuminate\Support\Facades\Redirect;
// use Inertia\Response;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);
        $settings = Setting::all()->map(function($setting) use ($user) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });        
        return Inertia::render('Roles/Admin/Admin',[
            'UserData' => $user,
            'settings' => $settings,
        ]);
    }
    public function partisipan()
    {
        return Inertia::render('Roles/Admin/Partisipan');
    }
    // public function pesan()
    // {
    //     return Inertia::render('Roles/Admin/Pesan');
    // }

    //LOMBA
    // public function lomba()
    // {
    //     return Inertia::render('Roles/Admin/Lomba');
    // }
    // public function tambahlomba()
    // {
    //     return Inertia::render('Roles/Admin/Lomba/Tambahlomba');
    // }
    // public function editlomba()
    // {
    //     return Inertia::render('Roles/Admin/Lomba/Editlomba');
    // }
    // public function detaillomba()
    // {
    //     return Inertia::render('Roles/Admin/Lomba/Detaillomba');
    // }

    //KRITERIA
    public function kriteria()
    {
        return Inertia::render('Roles/Admin/Lomba');
    }
    public function tambahkriteria()
    {
        return Inertia::render('Roles/Admin/Kriteria/Tambahkriteria');
    }
    public function editkriteria()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        }); 
        return Inertia::render('Roles/Admin/Kriteria/Editkriteria',[
            'settings' => $settings,
        ]);
    }
    public function detailkriteria()
    {
        return Inertia::render('Roles/Admin/Kriteria/Detailkriteria');
    }

    //ADMINISTRATOR
    // public function administrator()
    // {
    //     return Inertia::render('Roles/Admin/Administrator');
    // }
    // public function tambahadministrator()
    // {
    //     return Inertia::render('Roles/Admin/Administrator/Tambahadministrator');
    // }
    // public function detailadministrator()
    // {
    //     return Inertia::render('Roles/Admin/Administrator/Detailadministrator');
    // }

    //TIM
    public function tim()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        }); 
        return Inertia::render('Roles/Admin/Tim',[
            'settings' => $settings,
        ]);
    }
    public function tabeltim()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        }); 
        return Inertia::render('Roles/Admin/Tim/Tabeltim',[
            'settings' => $settings,
        ]);
    }
    public function detailtim()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        }); 
        return Inertia::render('Roles/Admin/Tim/Detailtim',[
            'settings' => $settings,
        ]);
    }

    //SPONSOR
    public function sponsor()
    {
        return Inertia::render('Roles/Admin/Sponsor');
    }
    public function tambahsponsor()
    {
        return Inertia::render('Roles/Admin/Sponsor/Tambahsponsor');
    }
    public function editsponsor()
    {
        return Inertia::render('Roles/Admin/Sponsor/Editsponsor');
    }
    public function detailsponsor()
    {
        return Inertia::render('Roles/Admin/Sponsor/Detailsponsor');
    }

    //BERITA
    public function berita()
    {
        return Inertia::render('Roles/Admin/Berita');
    }
    public function tambahberita()
    {
        return Inertia::render('Roles/Admin/Berita/Tambahberita');
    }
    public function editberita()
    {
        return Inertia::render('Roles/Admin/Berita/Editberita');
    }
    public function detailberita()
    {
        return Inertia::render('Roles/Admin/Berita/Detailberita');
    }

    //SETTING
    public function setting()
    {
        return Inertia::render('Roles/Admin/Setting');
    }
    public function tambahsetting()
    {
        return Inertia::render('Roles/Admin/Setting/Tambahsetting');
    }
    public function editsetting()
    {
        return Inertia::render('Roles/Admin/Setting/Editsetting');
    }

    //RANKING
    public function rangking()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });      
        return Inertia::render('Roles/Admin/Adminrangking', [
            'settings' => $settings,    
        ]);
    }
    public function tabelrangking()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });   
        return Inertia::render('Roles/Admin/Rangking/Tabelrangking', [
            'settings' => $settings,    
        ]);
    }
}
