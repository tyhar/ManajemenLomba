<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValueTeam extends Model
{
    use HasFactory;
    protected $table = 'values_team';

    // Atribut yang bisa diisi secara massal
    protected $fillable = [
        'value_total',
        'reg_lomba_id',
    ];

    public function regLomba()
    {
        return $this->hasMany(Reg_Lomba::class);
    }

}
