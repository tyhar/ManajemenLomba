<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Message;
use App\Models\Setting;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unreadCount = Message::where('status', 'belum_dibaca')->count();
        $setting = Setting::all();
        $user = Auth::user();
        $messages = Message::all()->map(function($message) use ($user) {
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
    
        return Inertia::render('Roles/Admin/Pesan', [
            'messages' => $messages,
            'settings' =>  $setting,
            'unreadCount' => $unreadCount
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Utama/Kontak', [
            'settings' => Setting::all()->map(function ($setting) {
                return [
                    'whatsApp' => $setting->whatsApp,
                    'instagram' => $setting->instagram,
                    'email' => $setting->email,
                    'youtube' => $setting->youtube,
                    'logo1' =>$setting->logo1,
                    'logo2' =>$setting->logo2,
                ];
            }),
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    
        // $request = Message::create([
        //     'name' => Request::input('name'),
        //     'email' => Request::input('email'),
        //     'phone' => Request::input('phone'),
        //     'value' => Request::input('value'),
        //     // 'status' => Request::input('status'),
        // ]);
        // dd($message);
        // return redirect()->route('pesan.create');
        // return redirect()->route('welcome');

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'value' => 'required',
            // 'status' => 'required',
            // Add more validation rules as needed
        ]);

        // Create the message
        $message = Message::create($validatedData);
        $unreadCount = Message::where('status', 'belum_dibaca')->count();

        // If everything is successful, redirect to a specific route
        return redirect()->route('pesan.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        $unreadCount = Message::where('status', 'belum_dibaca')->count();
        return Inertia::render('Roles/Admin/Pesan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
       //
    } 
    
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('pesan.index');
    }


public function updateStatus(Request $request, Message $message)
{
    $request->validate([
        'status' => 'required|in:sudah_dibaca,belum_dibaca',
    ]);

    $message->status = $request->status;
    $message->save();

    return redirect()->route('pesan.index');
}



}
