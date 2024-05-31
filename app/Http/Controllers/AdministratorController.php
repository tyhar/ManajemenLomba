<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\LombaResource;
use App\Models\Lomba;
use Inertia\Inertia;
use Illuminate\Http\Request;

use App\Models\Setting;
// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Response;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);
        return Inertia::render('Roles/Admin/Administrator', [
            'users' => User::all()->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->role,
                    'UserData'=>$user,
                ];
            }),
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
                    'logo1' => asset('storage/' . $setting->logo1),
                    'logo2' => asset('storage/' . $setting->logo2),
                    'logo3' => asset('storage/' . $setting->logo3),
                ];
            }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);
        $lomba = LombaResource::collection(Lomba::all());
        return Inertia::render('Roles/Admin/Administrator/Tambahadministrator',
        [
            'UserData' => $user,
            'lombas' => $lomba
        ]);
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request);
        $validatedData = $request->validate([
            'name' => ['required', 'max:50'],
            'username' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email'],
            'password' => ['required'],
            'role' => ['required', 'integer'],
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        // $validatedData['role'] = $request->input('role', 'peserta');
        $validatedData['role'] = $request->input('role');

        $user = User::create($validatedData);

        if ($request->has('selectedLomba')) {
            $user->lomba()->attach($request->input('selectedLomba'));
        }
        return redirect()->route('administrator.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);

        $users = User::with('lomba')->find($id);
        return Inertia::render('Roles/Admin/Administrator/Detailadministrator', [
            'users' => $users,
            'UserData' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($user);
        $user = User::find($id);
        $user->delete();
        // $user->delete();
        return redirect()->route('administrator.index');
    }
}
