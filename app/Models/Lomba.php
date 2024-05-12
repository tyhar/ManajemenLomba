<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    use HasFactory;

    protected $table = 'lombas';

    protected $fillable = [
        'event_lomba_id',
        'name',
        'description',
        'kontak',
        'pj',
        'tempat',
        'picture',
        'link_file',
        'price',
    ];

    public function eventlomba()
    {
        return $this->belongsTo(EventLomba::class, "event_lomba_id");
    }

    public function kriteria()
    {
        return $this->belongsToMany(Kriteria::class, table: "kriteria_lomba", foreignPivotKey: "lomba_id", relatedPivotKey: "kriteria_id");
    }
    // public function user() 
    // {
    //     return $this->hasMany(User::class);
    // }
}
