<?php

namespace App\Http\Controllers;

use App\Http\Resources\SponsorResource;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sponsors = SponsorResource::collection(Sponsor::all());

        return Inertia::render('Roles/Admin/Sponsor', [
            'sponsors' => $sponsors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $sponsors = SponsorResource::collection(Sponsor::all());

        return Inertia::render('Roles/Admin/Sponsor/Tambahsponsor');

        // return Inertia::render('Roles/Admin/Sponsor/Tambahsponsor',[
        //     'sponsors' => $sponsors,
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|max:2048',
            'link_file' => 'required|string|max:255'
        ]);
        $logo = $request->file('logo')->store('file_logo');
        Sponsor::create($validated);
    
        return redirect()->route('sponsor.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sponsor $sponsor)
    {
        return Inertia::render('Roles/Admin/Sponsor/Detailsponsor', [
            'sponsors' => SponsorResource::make($sponsor),
            dd($sponsor),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsor $sponsor)
    {
        return Inertia::render('Roles/Admin/Sponsor/Editsponsor', [
            'sponsors' => SponsorResource::make($sponsor),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|string|max:2048',
            'link_file' => 'required|string|max:255'
        ]);
        $sponsor->update($validatedData);

        // $sponsor->update($request->validated());

        return redirect()->route('sponsor.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {
        $sponsor->delete();
        return redirect()->route('sponsor.index');
    }
}
