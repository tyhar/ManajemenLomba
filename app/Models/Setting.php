<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'name',
        'judul',
        'sub_judul',
        'judul_des',
        'deskripsi',
        'mulai',
        'berakhir',
        'logo1',
        'logo2',
        'logo3',
    ];
}