<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'team_id',
        'status',
        
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('M d'); // Format: "Mey 21"
    }

}
