<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'user_id',
        'team_id',
        'status',
        
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('M d'); // Format: "Mey 21"
    }

}
