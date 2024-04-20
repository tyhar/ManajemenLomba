<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
// use Illuminate\Http\Request;
// use App\Http\Requests\ProfileUpdateRequest;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Redirect;
// use Inertia\Response;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Roles/Admin/Admin');
    }
}
