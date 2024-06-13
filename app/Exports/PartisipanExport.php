<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Team;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PartisipanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Username',
            'Instansi',
            'Email',
            'Status',
            'Tanggal',
        ];
    }
}
