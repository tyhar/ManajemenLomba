<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Symfony\Component\CssSelector\Node\FunctionNode;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 'lomba_id',
        'name',
        'username',
        'email',
        'password',
        'phone',
        'instansi',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //relasi untuk role eventlomba, spesifik per lombanya
    // public function lomba()
    // {
    //     $this->belongsTo(Lomba::class,'lomba_id');
    // }

    // public function reglomba()
    // {
    //     $this->hasOne(RegLomba::class);
    // }

    // public function reglombamember()
    // {
    //     $this->hasMany(RegLombaMember::class);
    // }
}
