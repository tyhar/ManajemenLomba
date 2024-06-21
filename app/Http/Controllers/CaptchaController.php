<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mews\Captcha\Facades\Captcha;

class CaptchaController extends Controller
{
    public function getCaptchaImage()
    {
        return response()->json(['captcha' => Captcha::src('flat')]);
    }
}
