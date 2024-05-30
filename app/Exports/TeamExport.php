<?php

namespace App\Exports;

use App\Models\Team;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeamExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Team::with('lomba')->get()->map(function ($team) {
            return [
                'Nama Tim' => $team->name_team,
                'Lomba' => $team->lomba->pluck('name_lomba')->join(', '), // Join Lomba names with comma
                'No WhatsApp' => $team->phone,
                'Email' => $team->email,
                'Instansi' => $team->instansi,
                'Status' => $team->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Tim',
            'Lomba',
            'No WhatsApp',
            'Email',
            'Instansi',
            'Status',
        ];
    }
}
