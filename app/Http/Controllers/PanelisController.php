<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class PanelisController extends Controller
{
    public function index()
    {
        return Inertia::render('Roles/Panelis/Dashboardjuri');
    }
    // public function dashboardjuri()
    // {
    //     return Inertia::render('Roles/Panelis/Dashboardjuri');
    // }

    //RANKING
    public function rangkingjuri()
    {
        return Inertia::render('Roles/Panelis/Rangkingjuri');
    }
    public function tabelrangkingjuri()
    {
        return Inertia::render('Roles/Panelis/Rangking/Tabelrangkingjuri');
    }
    public function lombajuri()
    {
        return Inertia::render('Roles/Panelis/Lombajuri');
    }
    public function tabellomba()
    {
        return Inertia::render('Roles/Panelis/Lomba/Tabellomba');
    }
    public function nilai()
    {
        return Inertia::render('Roles/Panelis/Lomba/Nilai');
    }

}
