<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
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
        return Inertia::render('Roles/User/Dashboard');
    }

    public function overviewpeserta()
    {
        return Inertia::render('Roles/User/Overviewpeserta');
    }
    public function detailpeserta()
    {
        return Inertia::render('Roles/User/Detailpeserta');
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
