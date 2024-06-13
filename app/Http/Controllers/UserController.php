<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Lomba;
use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Redirect;
use Inertia\Response;

class UserController extends Controller
{
    public function index(Request $request)
    {

       
        $user = $request->user();
        $registeredLombas = $user->lomba()->pluck('lomba_id');
        // Pass lomba status as props
        return Inertia::render('Roles/User/Dashboard', [
            'user' => $user,
            'lombas' => Lomba::all(),
            'registeredLombas' => $registeredLombas,

        ]);
        
    }

    public function overviewpeserta()
    {
        return Inertia::render('Roles/User/Overviewpeserta');
    }
    public function show($id)
    {
        $lombas = Lomba::all();
        $lomba = Lomba::findOrFail($id);
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);
        

        return Inertia::render('Roles/User/Detailpeserta', [
            'DataUser' => $user,
            'lombax' => $lomba,
            'lombas' => $lombas,

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

    public function checkStatus(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            return response()->json(['status' => $user->status]);
        } else {
            return response()->json(['status' => 'not_found'], 404);
        }
    }


    
}
