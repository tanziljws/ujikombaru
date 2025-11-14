<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    // IZINKAN FIELD judul, deskripsi, gambar, dan type untuk mass assignment
    protected $fillable = [
        'judul', 
        'deskripsi', 
        'gambar', 
        'type',
        'post_id',
        'position',
        'status',
        'kategori_id',
        'views',
        'likes',
        'dislikes'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }

    public function kategori()
    {
        return $this->belongsTo(GaleriKategori::class, 'kategori_id');
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function incrementLikes()
    {
        $this->increment('likes');
    }

    public function incrementDislikes()
    {
        $this->increment('dislikes');
    }

    // Relasi dengan likes
    public function galeriLikes()
    {
        return $this->hasMany(GaleriLike::class);
    }

    // Relasi dengan comments
    public function galeriComments()
    {
        return $this->hasMany(GaleriComment::class)->with('user')->latest();
    }

    // Check if user has liked
    public function isLikedBy($userId)
    {
        return $this->galeriLikes()->where('user_id', $userId)->where('type', 'like')->exists();
    }

    // Check if user has disliked
    public function isDislikedBy($userId)
    {
        return $this->galeriLikes()->where('user_id', $userId)->where('type', 'dislike')->exists();
    }
}
