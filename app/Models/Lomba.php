<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_lomba',
        'description',
        'kontak',
        'pj',
        'tempat',
        'picture',
        'kontak',
        'sertifikat',
        'biaya_pendaftaran',
        
    ];

    public function kriteria()
{
    return $this->belongsToMany(Kriteria::class,'kriteria_lombas_');
}
    public function user()
{
    return $this->belongsToMany(User::class,'user_lombas');
}
public function teams()
{
    return $this->hasMany(Team::class);
}


}

