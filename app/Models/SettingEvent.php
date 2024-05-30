<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_event',
        'title',
        'sub_title',
        'date_start',
        'date_end',
        'title_description',
        'description',
        'logo1',
        'logo2',
        'logo3',
        
    ];
}
