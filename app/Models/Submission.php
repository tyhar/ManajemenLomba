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
        'team_id'

    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function regLombas()
    {
        return $this->hasMany(Reg_Lomba::class);
    }

}
