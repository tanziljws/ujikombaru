<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriLike extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'galeri_id', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function galeri()
    {
        return $this->belongsTo(Galeri::class);
    }
}
