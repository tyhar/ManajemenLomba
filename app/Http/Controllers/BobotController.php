<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BobotController extends Controller
{
    public function edit($id)
    {
        $setting = Setting::all();
        $bobot = Bobot::findOrFail($id);

        return Inertia::render('Roles/Admin/Kriteria/EditBobot', [
            'bobots' => [
                'data' => $bobot,
            ],
            'userData' => auth()->user(),
            'settings' =>$setting, // Assuming you pass user data to the page props
        ]);
    }

    // Update the kriteria
    public function update(Request $request, $id)
    {
        $kriteria = Bobot::findOrFail($id);

        $request->validate([
            'nilai_bobot' => 'required|integer|',
        ]);

        $kriteria->update([
            'nilai_bobot' => $request->nilai_bobot,
        ]);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui!');
    }
    public function destroy($bobot)
    {

        $bobot = Bobot::findOrFail($bobot);
        $bobot->kriteria()->detach();
        $bobot->delete(); 
        
        return redirect()->route('kriteria.index');
    }
}
