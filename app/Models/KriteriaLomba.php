<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaLomba extends Model
{
    use HasFactory;
    protected $table = 'kriteria_lombas';

    // Atribut yang bisa diisi secara massal
    protected $fillable = [
        'kriteria_id',
        'lomba_id',
        'bobot',
    ];


    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
    public function lomba()
    {
        return $this->belongsTo(Lomba::class, 'lomba_id');
    }
    public function regLomba()
    {
        return $this->belongsTo(Reg_Lomba::class);
    }
    public function value()
    {
        return $this->hasMany(Value::class);
    }

     

}
