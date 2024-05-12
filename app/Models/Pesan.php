<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $table = 'pesans';

    protected $fillable = [
        'id',
        'nama',
        'email',
        'nomor',
        'pesan',
        'status'
    ];

}