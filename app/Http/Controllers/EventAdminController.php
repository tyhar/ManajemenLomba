<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;
use App\Http\Resources\UserResource;
use App\Models\Setting;



class EventAdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });   


        return Inertia::render('Roles/EventAdmin/Dashboardpetugas', [
            'UserData' => $user,
            'settings' => $settings, 
        ]);
    }



    public function partisipanpetugas()
    {


        $user = UserResource::collection(User::all());
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });  

        return inertia::render('Roles/EventAdmin/Partisipanpetugas', [

            'partisipans' => $user,
            'settings' => $settings,
        ]);

    }




    public function timpetugas()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });  
        return Inertia::render('Roles/EventAdmin/Timpetugas', [
            'settings' => $settings,
        ]);
    }
    public function timdetail()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });  
        return Inertia::render('Roles/EventAdmin/Tim/Timdetail', [
            'settings' => $settings,
        ]);
    }


    public function pesanpetugas()
    {
        $user = Auth::user();
        $messages = Message::all()->map(function ($message) use ($user) {
            return [
                'id' => $message->id,
                'name' => $message->name,
                'email' => $message->email,
                'phone' => $message->phone,
                'value' => $message->value,
                'status' => $message->status,
                'userData' => [
                    'name' => $user->name,
                    'username' => $user->username,
                ],
            ];
        });
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });  

        return Inertia::render('Roles/EventAdmin/Pesanpetugas', [
            'messages' => $messages,
            'settings' => $settings,
        ]);
    }

    public function rangkingpetugas()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });  
        return Inertia::render('Roles/EventAdmin/Rangkingpetugas', [
            'settings' => $settings,
        ]);
    }
    public function petugasrangking()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });  
        return Inertia::render('Roles/EventAdmin/Rangking/Petugasrangking', [
            'settings' => $settings,
        ]);
    }

    public function detailtimpetugas()
    {
        $settings = Setting::all()->map(function($setting) {
            return [
                'id' => $setting->id,
                'logo1' => asset('storage/'.$setting->logo1),
            ];
        });  
        return Inertia::render('Roles/EventAdmin/Rangking/Detailtimpetugas', [
            'settings' => $settings,
        ]);
    }

}