<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'kriteria_id',
        'value',
    ];

    /**
     * Get the kriteria that owns the kriteria value.
     */
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
