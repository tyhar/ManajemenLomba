<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLomba extends Model
{
    use HasFactory;

    protected $table = 'event_lombas';

    protected $fillable = [
        'name',
        'logo',
        'description',
        'year',
        'file_report',
    ];

    public function lomba()
    {
        return $this->hasOne(Lomba::class);
    }
}
