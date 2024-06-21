<?php

namespace App\Http\Controllers;

use App\Http\Resources\SponsorResource;
use App\Models\Sponsor;
use App\Models\Message;
use App\Models\Setting;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::all();
        $unreadCount = Message::where('status', 'belum_dibaca')->count();
        $user = Auth::user();
        $sponsors = Sponsor::all()->map(function ($sponsor) use ($user) {
            return [
                'UserData' => $user,
                'id' => $sponsor->id,
                'name' => $sponsor->name,
                'logo' => $sponsor->logo,
                'link_file' => $sponsor->link_file,
            ];
        });
        return Inertia::render('Roles/Admin/Sponsor', [
            'sponsors' => $sponsors,
            'userData' => [
                'name' => $user->name,
                'username' => $user->username,
            ],
            'settings' => $setting,
            'unreadCount' => $unreadCount,

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

        return Inertia::render('Roles/Admin/Sponsor/Tambahsponsor', [
            'UserData' => $user,
            'settings' => $setting,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'logo' => $logo,
        //     'link_file' => 'required|string|max:255'
        // ]);
        // Sponsor::create($validated);

        // dd($request);
        // store logo into sponsors folder inside public folder
        $logo = Request::file('logo')->store('sponsors', 'public');

        $sponsor = Sponsor::create([
            'name' => Request::input('name'),
            'logo' => $logo,
            'link_file' => Request::input('link_file')
        ]);


        return redirect()->route('sponsor.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sponsor $sponsor)
    {
        $setting = Setting::all();
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);
        $baseUrl = config('app.url');
        return Inertia::render('Roles/Admin/Sponsor/Detailsponsor', [
            'sponsors' => $sponsor,
            'logo' => asset('storage/' . $sponsor->logo),
            'baseUrl' => $baseUrl,
            'UserData' => $user,
            'settings' => $setting,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $setting = Setting::all();
        $sponsor = Sponsor::findOrFail($id);

        return Inertia::render('Roles/Admin/Sponsor/Editsponsor', [
            'sponsors' => $sponsor,
            'logo' => asset('storage/' . $sponsor->logo),
            'userData' => auth()->user(),
            'sponsors' => [
                'data' => $sponsor,
            ],
            'settings' => $setting,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        $logo = $sponsor->logo;
        if (Request::file('logo')) {
            Storage::delete('public/' . $sponsor->logo);
            $logo = Request::file('logo')->store('sponsors', 'public');
        }

        $sponsor->update([
            'name' => Request::input('name'),
            'logo' => $logo,
            'link_file' => Request::input('link_file')
        ]);

        return redirect()->route('sponsor.index');

        // $validatedData = $request->validate([
        //     'name' => Request::input('name'),
        //     'logo' => $logo,
        //     'link_file' => Request::input('link_file')
        // ]);
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'logo' => 'required|string|max:255',
        //     'link_file' => 'required|string|max:255'
        // ]);
        // Sponsor::create([
        // 'name' => Request::input('name'),
        // 'logo' => $logo,
        // 'link_file' => Request::input('link_file')
        // ]);
        // $sponsor->update($validatedData);
        // $sponsor->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {
        // dd($sponsor);
        Storage::delete('public/' . $sponsor->logo);
        $sponsor->delete();
        return redirect()->route('sponsor.index');
    }
}