<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'kontak',
        'pj',
        'tempat',
        'picture',
        'kontak',
        'sertifikat',
        'biaya_pendaftaran',
        
    ];

}
