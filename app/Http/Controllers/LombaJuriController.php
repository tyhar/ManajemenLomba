<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Reg_Lomba;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Lomba;
use App\Models\JuriLomba;
use App\Http\Resources\KriteriaResource;

class LombaJuriController extends Controller
{
    public function index()
    {
        // Fetch lombas for the authenticated user
        $user = auth()->user();
        $lombas = $user ? $user->lomba : [];
        $lombaId = JuriLomba::where('user_id', $user->id)->value('lomba_id');
        $beluminilai = Reg_Lomba::where('status', 'belum_dinilai')->where('lomba_id', $lombaId)->count();
        $totalteam = Reg_Lomba::where('lomba_id', $lombaId)->count();

    
        return inertia('Roles/Panelis/Lombajuri', [
            'lombas' => $lombas,
            'beluminilai' => $beluminilai,
            'totalteam' => $totalteam,
        
        ]);
    }
    

    public function show($lombaId)
    {
        $regLombas = Reg_Lomba::whereHas('team.lomba', function($query) use ($lombaId) {
            $query->where('lomba_id', $lombaId);
        })->with(['team', 'submission', 'lomba'])->get();
    
        return Inertia::render('Roles/Panelis/Lomba/Tabellomba', [
            'name' => auth()->user()->name,
            'username' => auth()->user()->username,
            'reg_lombas' => $regLombas,
            
        ]);
    }
    
    
    }  

