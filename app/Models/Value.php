<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
        use HasFactory;
    
        protected $fillable = [
            'kriteria_id',
            'user_id',
            'value_count'
            ];
    
        public function kriteria()
        {
            return $this->belongsTo(Kriteria::class);
        }
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
