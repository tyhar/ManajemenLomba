<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'team_id',
        'user_id',
        'role',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function regLombas()
    {
        return $this->belongsTo(Reg_Lomba::class);
    }
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
    public function notifikasi()
{
    return $this->hasMany(Notifikasi::class);
}
}
