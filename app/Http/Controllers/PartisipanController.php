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
        // Menghitung pesan yang belum dibaca
        $unreadCount = Message::where('status', 'belum_dibaca')->count();
        
        // Mengambil semua pengaturan
        $setting = Setting::all();
        
        // Mengambil pengguna dengan role 3 (misalnya partisipan)
       
        
        $users = User::where('role', 3)->get();
        
        // Transform the collection
        $userResources = UserResource::collection($users);
        // Merender tampilan dengan data yang dikumpulkan
        return Inertia::render('Roles/Admin/Partisipan', [
            'partisipans' => $userResources,
            'settings' => $setting,
            'unreadCount' => $unreadCount
        ]);
    }
    



}
