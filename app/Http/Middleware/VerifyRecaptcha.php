<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use ReCaptcha\ReCaptcha;

class VerifyRecaptcha
{
    public function handle(Request $request, Closure $next)
    {
        $recaptcha = new ReCaptcha(env('VITE_CAPTCHA_SECRET'));
        $response = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());

        if (!$response->isSuccess()) {
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'ReCAPTCHA verification failed.']);
        }

        return $next($request);
    }
}
