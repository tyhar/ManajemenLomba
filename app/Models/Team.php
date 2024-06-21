<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $table = 'team';
    protected $fillable = [
        'name_team',
        'email',
        'phone',
        'instansi',
        'payment',
        'lomba_id',
        'status',
        'user_id',
    ];
    public function lomba()
    {
        return $this->belongsTo(Lomba::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
    public function team_member()
    {
        return $this->hasMany(Team::class);
    }
    public function regLombas()
    {
        return $this->hasMany(Reg_Lomba::class);
    }
    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class);
    }
    public function userStatus()
    {
        return $this->hasOne(UserStatus::class, 'user_id', 'user_id');
    }

}
