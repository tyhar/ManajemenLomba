<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Setting;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;


class PartisipanController extends Controller
{
    public function index()
{


    $user = UserResource::collection(User::all());
    $settings = Setting::all()->map(function($setting) {
        return [
            'id' => $setting->id,
            'logo1' => asset('storage/'.$setting->logo1),
        ];
    });     

    return inertia::render('Roles/Admin/Partisipan', [

    'partisipans' => $user,
    'settings' => $settings,

    ]);

}



}
