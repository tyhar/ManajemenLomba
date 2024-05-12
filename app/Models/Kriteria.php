<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';

    protected $fillable = [
        'name'
    ];

    public function lomba() 
    {
        return $this->belongsToMany(Kriteria::class, table: 'kriteria_lomba', foreignPivotKey: 'kriteria_id', relatedPivotKey: 'lomba_id');
    }
}
