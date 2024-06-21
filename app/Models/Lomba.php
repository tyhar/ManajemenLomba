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
        return $this->belongsToMany(Kriteria::class, 'kriteria_lombas')
                    ->withPivot('bobot')
                    ->withTimestamps();
    }
    public function user()
{
    return $this->belongsToMany(User::class,'user_lombas');
}
public function teams()
{
    return $this->hasMany(Team::class);
}
public function submissions()
{
    return $this->hasMany(Submission::class);
}
public function regLombas()
{
    return $this->hasMany(Reg_Lomba::class);
}



}

