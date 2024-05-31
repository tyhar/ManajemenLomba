<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Lomba;
use App\Models\User;
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
        return Inertia::render('Roles/User/Dashboard', [
            'UserData' => $user,
            'lombas' => $lomba,
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
        

        return Inertia::render('Roles/User/Detailpeserta', [
            'DataUser' => $user,
            'lombax' => $lomba,

        ]);
    }
    public function profilpeserta()
    {
        return Inertia::render('Roles/User/Profilpeserta');
    }
    public function notifikasipeserta()
    {
        return Inertia::render('Roles/User/Notifikasipeserta');
    }
    public function reportpeserta()
    {
        return Inertia::render('Roles/User/Reportpeserta');
    }
    public function detailtimreport()
    {
        return Inertia::render('Roles/User/Report/Detailtimreport');
    }
    public function tahap2()
    {
        return Inertia::render('Roles/User/Report/Tahap2');
    }
    public function daftarlomba()
    {
        return Inertia::render('Roles/User/Daftarlomba');
    }
    public function datatim()
    {
        return Inertia::render('Roles/User/Daftar/Datatim');
    }
    public function anggotatim()
    {
        return Inertia::render('Roles/User/Daftar/Anggotatim');
    }
    public function pengumpulankarya()
    {
        return Inertia::render('Roles/User/Daftar/Pengumpulankarya');
    }




    
}
