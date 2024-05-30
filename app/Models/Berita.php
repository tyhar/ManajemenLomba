<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'beritas';
    protected $fillable = [
        'judul',
        'deskripsi_awal',
        'deskripsi',
        'penerbit',
        'tanggal_upload',
        'images'
    ];

    protected $casts = [
        'tanggal_upload' => 'date:Y-m-d'
    ];
}