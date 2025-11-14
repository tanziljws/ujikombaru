<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'nisn',
        'password',
        'avatar',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi dengan likes
    public function likes()
    {
        return $this->hasMany(GaleriLike::class);
    }

    // Relasi dengan comments
    public function comments()
    {
        return $this->hasMany(GaleriComment::class);
    }
}
