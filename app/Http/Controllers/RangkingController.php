<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use App\Models\Message;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\Lomba;
use App\Models\Reg_Lomba;
use App\Models\Setting;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RangkingController extends Controller
{
    public function show($lomba_id)
    {

        $settings = Setting::all();
        $unreadCount = Message::where('status', 'belum_dibaca')->count();
        $user = Auth::user();

        // Ensure the user is authenticated
        if (!$user) {
            return Redirect::route('login');
        }

        // Fetching Reg_lomba data with relationships based on lomba_id
        $reg_lombas = Reg_Lomba::whereHas('team', function($query) use ($lomba_id) {
            $query->where('lomba_id', $lomba_id);
        })->with(['team', 'team.lomba', 'submission','lomba'])->get();

        return Inertia::render('Roles/EventAdmin/Rangking/Petugasrangking', [
            'userData' => $user,
            'reg_lombas' => $reg_lombas,
            'settings' => $settings,
            'unreadCount' => $unreadCount,
        ]);
    }
}
