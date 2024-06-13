<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_member_id', // Make sure this matches your actual column name
        'file_path',
    ];

    // Define the relationship with the TeamMember model
    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class);
    }
}
