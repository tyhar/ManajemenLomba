<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaLombaBobot extends Model
{
    use HasFactory;
    protected $table = 'kriteria_lomba_bobots';
    protected $fillable = [
        'kriteria_bobot_id',
        'lomba_id',
    ];
    public function regLomba()
    {
        return $this->belongsTo(Reg_Lomba::class, 'reg_lomba_id');
    }
    public function kriteria_bobot()
    {
        return $this->belongsTo(KriteriaBobot::class);
    }


}
