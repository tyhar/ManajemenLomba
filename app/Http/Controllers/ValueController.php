<?php

namespace App\Http\Controllers;

use App\Models\Value;
use App\Models\User;
use App\Models\Lomba;
use App\Models\Reg_Lomba;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\Submission;
use App\Models\KriteriaLomba;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ValueResource;
use App\Http\Resources\KriteriaResource;
use App\Models\JuriLomba;
use Illuminate\Support\Facades\Validator;

class ValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required|array',
            'data.*.kriteria_lomba_id' => 'required|exists:kriteria_lombas,id',
            'data.*.reg_lomba_id' => 'required|exists:reg_lombas,id',
            'data.*.value_count' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = Auth::user();
        $regLombaValues = [];
    
        foreach ($request->data as $item) {
            Value::create([
                'reg_lomba_id' => $item['reg_lomba_id'],
                'kriteria_lomba_id' => $item['kriteria_lomba_id'],
                'value_count' => $item['value_count'],
                'user_id' => $user->id,
            ]);
    
            // Sum the value_count for each reg_lomba_id
            if (!isset($regLombaValues[$item['reg_lomba_id']])) {
                $regLombaValues[$item['reg_lomba_id']] = 0;
            }
            $regLombaValues[$item['reg_lomba_id']] += $item['value_count'];
        }
    
        foreach ($regLombaValues as $regLombaId => $valueTotal) {
            // Update the status and value_total in Reg_Lomba table
            Reg_Lomba::where('id', $regLombaId)->update([
                'status' => 'sudah_dinilai',
                'value_total' => $valueTotal,
            ]);
        }
    
        return redirect()->route('panelis')->with('success', 'Data successfully saved');
    }
    
    

    public function show($reg_lomba_id, $team_id)
    {
        $settings = Setting::all();

        $user = Auth::user();
    
        // Fetch the reg_lomba using the provided ID
        $regLomba = Reg_Lomba::with('team', 'lomba', 'submission')->findOrFail($reg_lomba_id);
    
        // Fetch the team using the provided ID
        $team = Team::with(['lomba', 'user'])->findOrFail($team_id);
    
        // Fetch the submission related to the team
        $submission = Submission::where('team_id', $team->id)->first();
    
        // Fetch the team members related to the team
        $teamMembers = TeamMember::where('team_id', $team->id)->with('user')->get();

        
    
        return Inertia::render('Roles/Panelis/Lomba/Timdetailjuri', [
            'userData' => $user,
            'reg_lombas' => $regLomba,
            'team' => $team,
            'submissions' => $submission,
            'members' => $teamMembers,
            'settings' => $settings,
        ]);
    }
    
    public function edit(int $reg_lomba_id, int $lomba_id)
    {
        $settings = Setting::all();
        $user = Auth::user();
        
        // Fetch the value for the specified reg_lomba_id
        $values = Value::with(['reg_lomba', 'kriteria_lomba'])
            ->where('reg_lomba_id', $reg_lomba_id)
            ->get();
            
        // Fetch the reg_lomba details
        $regLomba = Reg_Lomba::with(['team', 'lomba', 'submission'])->findOrFail($reg_lomba_id);
        
        // Fetch the kriterias associated with the specified lomba_id
        $kriterias = KriteriaLomba::with('kriteria')
            ->whereHas('kriteria', function($query) use ($lomba_id) {
                $query->where('lomba_id', $lomba_id);
            })->get();
    
        // Prepare value data to include `value_count` calculated as needed
        $valueData = $values->map(function($value) {
            return [
                'id' => $value->id,
                'kriteria_lomba_id' => $value->kriteria_lomba_id,
                'value_count' => ($value->value_count) 
            ];
        });
    
        return Inertia::render('Roles/Panelis/Lomba/Editnilai', [
            'value' => $valueData,
            'kriterias' => $kriterias,
            'userData' => $user,
            'reg_lombas' => $regLomba,
            'settings' => $settings,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'data.*.value_count' => 'required|numeric',
            'data.*.kriteria_lomba_id' => 'required|exists:kriteria_lombas,id',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        try {
            // Array to keep track of reg_lomba_ids for which values are updated
            $updatedRegLombaIds = [];
    
            foreach ($request->input('data') as $item) {
                $value = Value::where('kriteria_lomba_id', $item['kriteria_lomba_id'])
                              ->where('reg_lomba_id', $item['reg_lomba_id'])
                              ->firstOrFail();
    
                $value->update([
                    'value_count' => $item['value_count'],
                ]);
    
                // Add reg_lomba_id to the array
                $updatedRegLombaIds[] = $item['reg_lomba_id'];
            }
    
            // Recalculate and update value_total for each updated reg_lomba_id
            $updatedRegLombaIds = array_unique($updatedRegLombaIds);
    
            foreach ($updatedRegLombaIds as $regLombaId) {
                $totalValue = Value::where('reg_lomba_id', $regLombaId)->sum('value_count');
    
                Reg_Lomba::where('id', $regLombaId)->update([
                    'value_total' => $totalValue,
                    'status' => 'sudah_dinilai', // Optionally update status
                ]);
            }
    
            return redirect()->route('panelis')->with('success', 'Nilai updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the values');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kriteria)
    {

        $kriteria = Kriteria::findOrFail($kriteria);
        $kriteria->delete();

        return redirect()->route('kriteria.index');
    }

}