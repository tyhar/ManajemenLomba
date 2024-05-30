<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;


class PartisipanController extends Controller
{
    public function index()
{


    $user = UserResource::collection(User::all());

    return inertia::render('Roles/Admin/Partisipan', [

    'partisipans' => $user,

    ]);

}



}
