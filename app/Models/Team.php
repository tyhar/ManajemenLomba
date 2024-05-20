<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $table = 'teams';
    protected $fillable = [
        'name_team',
        'email',
        'phone',
        'instansi',
        'payment',
        'lomba_id',
        'status',
    ];
    public function lomba()
    {
        return $this->belongsToMany(Lomba::class,'team_lombas');
    }
    

}
