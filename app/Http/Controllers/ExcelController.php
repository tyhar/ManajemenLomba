<?php

namespace App\Http\Controllers;

use App\Exports\PartisipanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function export() 
    {
        return Excel::download(new PartisipanExport, 'partisipan.xlsx');
    }
}
