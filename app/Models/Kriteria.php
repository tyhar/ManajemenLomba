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

    /**
     * Get the values associated with the kriteria.
     */
    public function kriteriaValues()
    {
        return $this->hasMany(KriteriaValue::class);
    }
}
