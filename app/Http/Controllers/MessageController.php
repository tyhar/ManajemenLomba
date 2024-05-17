<?php

namespace App\Http\Controllers;

use App\Models\Message;

use App\Models\Setting;
// use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Roles/Admin/Pesan', [
            'messages' => Message::all()->map(function($message) {
                return [
                    'id' => $message->id,
                    'name' => $message->name,
                    'email' => $message->email,
                    'phone' => $message->phone,
                    'value' => $message->value,
                    'status' => $message->status,
                ];
            }),
            'settings' => Setting::all()->map(function($setting) {
                return [
                    'id' => $setting->id,
                    'name' => $setting->name,
                    'judul' => $setting->judul,
                    'sub_judul' => $setting->sub_judul,
                    'judul_des' => $setting->judul_des,
                    'deskripsi' => $setting->deskripsi,
                    'mulai' => $setting->mulai,
                    'berakhir' => $setting->berakhir,
                    'logo1' => asset('storage/' . $setting->logo1),
                    'logo2' => asset('storage/' . $setting->logo2),
                    'logo3' => asset('storage/' . $setting->logo3),
                ];
            }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Utama/Kontak');
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

        // If everything is successful, redirect to a specific route
        return redirect()->route('welcome');
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
        //
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
}
