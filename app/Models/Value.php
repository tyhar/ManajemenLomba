<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kriteria_lomba_id',
        'value_count',
        'reg_lomba_id',
    ];

    public function juri_lomba()
    {
        return $this->belongsTo(JuriLomba::class);
    }

    public function kriteria_lomba()
    {
        return $this->belongsTo(KriteriaLomba::class);
    }

    public function reg_lomba()
    {
        return $this->belongsTo(Reg_Lomba::class);
    }
}
