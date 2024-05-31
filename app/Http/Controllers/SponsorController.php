<?php

namespace App\Http\Controllers;

use App\Http\Resources\SponsorResource;
use App\Models\Sponsor;
// use Illuminate\Http\Request;
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
        // $sponsors = SponsorResource::collection([
            // Sponsor::all()->map(function($sponsor) {
            //     return [
            //         'id' => $sponsor->id,
            //         'name' => $sponsor->name,
            //         'link_file' => $sponsor->link_file,
            //         'logo' => asset('storage/'.$sponsor->logo)
            //     ];
        //     })
        // ]); 

        // $sponsors = SponsorResource::collection(Sponsor::all());

        // return Inertia::render('Roles/Admin/Sponsor', [
        //     'sponsors' => $sponsors,
        // ]);

        return Inertia::render('Roles/Admin/Sponsor', [
            'sponsors' => Sponsor::all()->map(function($sponsor) {
                return [
                    'id' => $sponsor->id,
                    'name' => $sponsor->name,
                    'link_file' => $sponsor->link_file,
                    'logo' => asset('storage/'.$sponsor->logo)
                ];
            })
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

        return Inertia::render('Roles/Admin/Sponsor/Tambahsponsor', [
            'UserData' => $user,
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
        $logo = Request::file('logo')->store('sponsors','public');
    
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
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);
        $baseUrl = config('app.url');
        return Inertia::render('Roles/Admin/Sponsor/Detailsponsor', [
            'sponsors' => $sponsor,
            'logo' => asset('storage/'.$sponsor->logo),
            'baseUrl' => $baseUrl,
            'UserData' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsor $sponsor)
    {
        $user = Auth::user();
        Inertia::share('userData', [
            'sponsors' => SponsorResource::make($sponsor), 
            'name' => $user->name,
            'username' => $user->username,
        ]);

        return Inertia::render('Roles/Admin/Sponsor/Editsponsor', [
            'sponsors' => $sponsor,
            'logo' => asset('storage/'.$sponsor->logo),
            'UserData' => $user,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        $logo = $sponsor->logo;
        if(Request::file('logo')){
            Storage::delete('public/'.$sponsor->logo);
            $logo = Request::file('logo')->store('sponsors','public');
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
        Storage::delete('public/'.$sponsor->logo);
        $sponsor->delete();
        return redirect()->route('sponsor.index');
    }
}
