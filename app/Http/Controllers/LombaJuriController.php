<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Reg_Lomba;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Lomba;
use App\Models\Setting;
use App\Models\JuriLomba;
use App\Http\Resources\KriteriaResource;

class LombaJuriController extends Controller
{
    public function index()
    {
        // Fetch lombas for the authenticated user
        $user = auth()->user();
        $lombas = $user ? $user->lomba : [];
    
        // Calculate the number of entries already judged and total teams for each lomba
        $lombas = $lombas->map(function ($lomba) {
            $lombaId = $lomba->id;
            $lomba->sudah_dinilai = Reg_Lomba::where('status', 'sudah_dinilai')->where('lomba_id', $lombaId)->count();
            $lomba->totalteam = Reg_Lomba::where('lomba_id', $lombaId)
                ->where('status_kelulusan', 'terverifikasi')
                ->count();
            return $lomba;
        });
    
        // Fetch settings
        $settings = Setting::all();
    
        return inertia('Roles/Panelis/Lombajuri', [
            'lombas' => $lombas,
            'settings' => $settings,
        ]);
    }
    

    public function show($lombaId)
    {
        $regLombas = Reg_Lomba::whereHas('team.lomba', function($query) use ($lombaId) {
            $query->where('lomba_id', $lombaId);
        })->with(['team', 'submission', 'lomba'])->get();
        $settings = Setting::all();
        return Inertia::render('Roles/Panelis/Lomba/Tabellomba', [
            'name' => auth()->user()->name,
            'username' => auth()->user()->username,
            'reg_lombas' => $regLombas,
            'settings' => $settings,
            
        ]);
    }
    
    
    }  

