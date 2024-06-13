<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'link',
        'file',
        'surat',
        'team_id',
        'user_id',
        'lomba_id',

    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function regLombas()
    {
        return $this->hasMany(Reg_Lomba::class);
    }
    public function user()
     {
        return $this->belongsTo(User::class);
     }
     public function lomba()
     {
        return $this->belongsTo(Lomba::class);
     }

}
