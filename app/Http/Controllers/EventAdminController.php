<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;
use App\Http\Resources\UserResource;





class EventAdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        Inertia::share('userData', [
            'name' => $user->name,
            'username' => $user->username,
        ]);


        return Inertia::render('Roles/EventAdmin/Dashboardpetugas', [
            'UserData' => $user,
        ]);
    }



    public function partisipanpetugas()
    {


        $user = UserResource::collection(User::all());

        return inertia::render('Roles/EventAdmin/Partisipanpetugas', [

            'partisipans' => $user,

        ]);

    }




    public function timpetugas()
    {
        return Inertia::render('Roles/EventAdmin/Timpetugas');
    }
    public function timdetail()
    {
        return Inertia::render('Roles/EventAdmin/Tim/Timdetail');
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

        return Inertia::render('Roles/EventAdmin/Pesanpetugas', [
            'messages' => $messages,
        ]);
    }

    public function rangkingpetugas()
    {
        return Inertia::render('Roles/EventAdmin/Rangkingpetugas');
    }
    public function petugasrangking()
    {
        return Inertia::render('Roles/EventAdmin/Rangking/Petugasrangking');
    }

    public function detailtimpetugas()
    {
        return Inertia::render('Roles/EventAdmin/Rangking/Detailtimpetugas');
    }

}