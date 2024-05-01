<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'description',
        'kontak',
        'tempat',
        'picture',
        'link_file',
    ];

    public function eventlomba() 
    {
        return $this->belongsTo(Eventlomba::class, 'eventlomba_id');
    }
}
