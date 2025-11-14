<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'kategori_id',
        'isi',
        'user_id',
        'status'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function galeris()
    {
        return $this->hasMany(Galeri::class);
    }

    public function komens()
    {
        return $this->hasMany(Komen::class);
    }
}
