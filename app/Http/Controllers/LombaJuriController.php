<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Reg_lomba;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Lomba;
use App\Http\Resources\KriteriaResource;

class LombaJuriController extends Controller
{
    public function index()
    {
        // Fetch lombas for the authenticated user
        $user = auth()->user();
        $lombas = $user ? $user->lomba : [];
    
        return inertia('Roles/Panelis/Lombajuri', ['lombas' => $lombas]);
    }
    

    public function show($lombaId)
    {
        $regLombas = Reg_lomba::whereHas('team.lomba', function($query) use ($lombaId) {
            $query->where('lomba_id', $lombaId);
        })->with(['team', 'submission', 'lomba'])->get();
    
        return Inertia::render('Roles/Panelis/Lomba/Tabellomba', [
            'name' => auth()->user()->name,
            'username' => auth()->user()->username,
            'reg_lombas' => $regLombas,
            
        ]);
    }
    
    
    
}
