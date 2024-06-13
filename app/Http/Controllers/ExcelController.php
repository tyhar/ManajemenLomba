<?php
namespace App\Http\Controllers;

use App\Exports\PartisipanExport;
use App\Exports\TeamExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function exportPartisipan() 
    {
        return Excel::download(new PartisipanExport, 'partisipan.xlsx');
    }

    public function exportTeam() 
    {
        return Excel::download(new TeamExport, 'team.xlsx');
    }
}
