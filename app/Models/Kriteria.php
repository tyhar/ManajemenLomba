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

    public function lombas()
    {
        return $this->belongsToMany(Lomba::class,'kriteria_lombas_');
    }

}
