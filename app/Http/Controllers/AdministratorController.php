<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Http\Resources\LombaResource;
use App\Models\Lomba;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Setting;
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
        $newStatus = User::where('status', 'aktif')->get();
        $setting = Setting::all();
        $unreadCount = Message::where('status', 'belum_dibaca')->count();
        $user = Auth::user();
    
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
            'status' => $user->status
        ]);
    
        return Inertia::render('Roles/Admin/Administrator', [
            'users' => User::whereIn('role', [1, 2, 4])->get()->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'status' => $user->status,
                    'email' => $user->email,
                    'role' => $user->role,
                    'UserData' => $user,
                ];
            }),
            'settings' => $setting,
            'unreadCount' => $unreadCount,
            'newStatus' => $newStatus,
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::all();
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);
        $lomba = LombaResource::collection(Lomba::all());
        return Inertia::render('Roles/Admin/Administrator/Tambahadministrator',
        [
            'UserData' => $user,
            'lombas' => $lomba,
            'settings' => $setting,
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
        $setting = Setting::all();
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);

        $users = User::with('lomba')->find($id);
        return Inertia::render('Roles/Admin/Administrator/Detailadministrator', [
            'users' => $users,
            'UserData' => $user,
            'settings' => $setting,
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

    public function updateStatus(Request $request, $id)
    {
        // Temukan pengguna berdasarkan ID
        $user = User::findOrFail($id);
        
        // Validasi request
        $request->validate([
            'status' => 'required|in:aktif,nonaktif',
        ]);
        
        // Perbarui status pengguna
        $user->status = $request->status;
        $user->save();

        return redirect()->route('administrator.index');
    }
}
