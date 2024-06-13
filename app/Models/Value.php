<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
        use HasFactory;
        protected $table = 'values';
        protected $fillable = [
            'user_id',
            'kriteria_lomba_bobot_id',
            'reg_lomba_id',
            'value_count',
            ];
    
        public function kriterialombabobot()
        {
            return $this->belongsTo(KriteriaLombaBobot::class);
        }
        public function user()
        {
            return $this->belongsTo(User::class);
        }
        public function regLomba()
        {
            return $this->belongsTo(RegLomba::class); // Assuming RegLomba is the model name
        }
        
}



