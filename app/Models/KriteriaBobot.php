<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaBobot extends Model
{
    use HasFactory;
    protected $table = 'kriteria_bobots';
    protected $fillable = [
        'bobot_id',
        'kriteria_id',
    ];

    
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function bobot()
    {
        return $this->belongsTo(Bobot::class);
    }
    public function lomba()
    {
        return $this->belongsToMany(Lomba::class,'kriteria_lomba_bobots');
    }
}
