<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
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
        return Inertia::render('Roles/Admin/Administrator', [
            'users' => User::all()->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->role
                ];
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Roles/Admin/Administrator/Tambahadministrator');
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

        // dd($validatedData);
        // dd($user);
        return redirect()->route('administrator.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // dd($user);
        $user = User::find($id);
        return Inertia::render('Roles/Admin/Administrator/Detailadministrator', [
            'users' => $user,
            // dd($user)
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
