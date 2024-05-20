<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reg_Lomba extends Model
{
    use HasFactory;
    protected $table = 'reg_lombas';

    protected $fillable = [
        'team_id',
        'team_member_id',
        'submission_id',
        'status',
    ];


}
