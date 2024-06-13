<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;
use App\Models\Setting;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;


class PartisipanController extends Controller
{
    public function index()
{

    $unreadCount = Message::where('status', 'belum_dibaca')->count();
    $setting = Setting::all();
    $user = UserResource::collection(User::all());

    return inertia::render('Roles/Admin/Partisipan', [

    'partisipans' => $user,
    
    'settings' =>  $setting,
    'unreadCount' => $unreadCount

    ]);

}



}
