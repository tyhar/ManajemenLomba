<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reg_Lomba extends Model
{
    use HasFactory;
    protected $table = 'reg_lombas';

    protected $fillable = [
        'user_id',
        'team_id',
        'submission_id',
        'lomba_id',
        'status',
        'status_kelulusan',
        'value_total',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function teamMember()
    {
        return $this->hasMany(TeamMember::class);
    }

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
    public function lomba()
    {
        return $this->belongsTo(Lomba::class);
    }
 
    public function kriterialomba()
    {
        return $this->hasMany(KriteriaLomba::class);
    }
    public function user_lombas()
    {
        return $this->belongsTo(JuriLomba::class,'lomba_id');
    }
    public function juri_lomba()
    {
        return $this->belongsTo(JuriLomba::class, 'lomba_id', 'lomba_id');
    }

}
