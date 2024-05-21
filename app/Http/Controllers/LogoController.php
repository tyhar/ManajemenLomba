<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoController extends Controller
{
    public function getLogo()
    {
        $logoUrl = 'public/bootstrap/logocb.png';
        return response()->json(['logoUrl' => $logoUrl]);
    }
}
