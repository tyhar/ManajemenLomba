<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class EventAdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Roles/EventAdmin/EventAdmin');
    }
    // public function dashboardpetugas()
    // {
    //     return Inertia::render('Roles/EventAdmin/Dashboardpetugas');
    // }

    public function partisipanpetugas()
    {
        return Inertia::render('Roles/EventAdmin/Partisipanpetugas');
    }
    public function timpetugas()
    {
        return Inertia::render('Roles/EventAdmin/Timpetugas');
    }
    public function timdetail()
    {
        return Inertia::render('Roles/EventAdmin/Tim/Timdetail');
    }
    public function pesanpetugas()
    {
        return Inertia::render('Roles/EventAdmin/Pesanpetugas');
    }
    public function rangkingpetugas()
    {
        return Inertia::render('Roles/EventAdmin/Rangkingpetugas');
    }
    public function petugasrangking()
    {
        return Inertia::render('Roles/EventAdmin/Rangking/Petugasrangking');
    }

}
