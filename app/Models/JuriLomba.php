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
    public function regLomba()
    {
        return $this->hasOneThrough(Reg_Lomba::class, Lomba::class, 'id', 'lomba_id', 'lomba_id', 'id');
    }
}
