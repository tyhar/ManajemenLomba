<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use HasFactory;

    protected $table = 'user_status';

    protected $fillable = [
       'user_id', 
       'status_ketua_team',
       'lomba_id'
    
    ];

    /**
     * Get the user that owns the status.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function team()
    {
        return $this->belongsTo(Team::class, 'user_id', 'user_id');
    }
}
