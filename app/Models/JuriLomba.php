<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuriLomba extends Model
{
    use HasFactory;
    protected $table = 'user_lombas';

    // Atribut yang bisa diisi secara massal
    protected $fillable = [
        'user_id',
        'lomba_id',
    ];

    // Relasi ke model Lomba
    public function lomba()
    {
        return $this->belongsTo(Lomba::class);
    }

    // Relasi ke model RegLomba jika ada
    public function reg_lombas()
    {
        return $this->hasMany(Reg_Lomba::class, 'lomba_id', 'lomba_id');
    }
    
}
