<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bobot extends Model
{
    protected $fillable = [
        'nilai_bobot',
    ];

    public function kriteria()
    {
        return $this->belongsToMany(Kriteria::class,'kriteria_bobots');
        
    }
}
