<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
// use Illuminate\Http\Request;
// use App\Http\Requests\ProfileUpdateRequest;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Redirect;
// use Inertia\Response;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Roles/User/Dashboard');
    }
}
