<?php

namespace App\Http\Controllers;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Http\Request;

class PeopleController extends Controller
{
    function index()
{
    $data = User::orderBy('name', 'asc')->get();
    return route("people.index", ['data'=>$data] );

}
function export_excel(){
    return Excel::download(new ExportPeople, "people.xlsx");

}




}