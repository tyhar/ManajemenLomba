<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriterias';
    protected $fillable = [
        'name_kriteria',
    ];


    
    public function lomba()
    {
        return $this->belongsToMany(Lomba::class, 'kriteria_lombas')
                    ->withPivot('bobot')
                    ->withTimestamps();
    }
    public function regLombas()
{
    return $this->hasMany(Reg_Lomba::class);
}
}
