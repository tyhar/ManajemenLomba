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
    public function dashboardjuri()
    {
        return Inertia::render('Roles/Panelis/Dashboardjuri');
    }

    //RANKING
    public function rangking()
    {
        return Inertia::render('Roles/Admin/Adminrangking');
    }
    public function tabelrangking()
    {
        return Inertia::render('Roles/Admin/Rangking/Tabelrangking');
    }
}
