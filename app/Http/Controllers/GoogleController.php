<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    public function googlepage()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
       
            $finduser = User::where('google_id', $user->id)->orWhere('email', $user->email)->first();
       
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy'),
                    'email_verification_status' => 'verified' // Set email verification status to verified
                ]);

                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
        } catch (\Throwable $e) {
            // Handle errors with a more informative message
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login melalui Google. Silakan coba lagi.');
        }
    }
}
