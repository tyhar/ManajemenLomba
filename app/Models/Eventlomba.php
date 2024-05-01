<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventlomba extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'description',
        'year',
        'file_report',
    ];

    public function lomba()
    {
        return $this->hasMany(Lomba::class);
    }
}
