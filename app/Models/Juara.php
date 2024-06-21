<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juara extends Model
{
    use HasFactory;
    protected $table = 'juaras';

    protected $fillable = [
       'reg_lomba_id', 
       'juara'

];
}
