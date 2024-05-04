<?php

namespace App\Exports;
use App\Model\User;
use Illuminate\Http\Request;
use Maatwesite\Excel\Facades\Excel;
use Inertia\Inertia;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExportPeople implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::orderBy('name', 'asc')->get();
        return route("people.index", ['data' =>  $data]);
    }
   function export_excel(){
    return Excel::download(new ExportPeople, "people.xlsx");
   }


}



