<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class PanelisController extends Controller
{
    public function index()
    {
        return Inertia::render('Roles/Panelis/Panelis');
    }
}
