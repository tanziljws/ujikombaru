<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiSekolah extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'type',
        'key', 
        'value',
        'order'
    ];
    
    // Method untuk mendapatkan data berdasarkan type
    public static function getByType($type)
    {
        return static::where('type', $type)->orderBy('order')->get();
    }
    
    // Method untuk mendapatkan data jurusan
    public static function getJurusan()
    {
        return static::getByType('jurusan');
    }
    
    // Method untuk mendapatkan data akreditasi
    public static function getAkreditasi()
    {
        return static::getByType('akreditasi');
    }
    
    // Method untuk mendapatkan data kontak
    public static function getKontak()
    {
        return static::getByType('kontak');
    }
    
    // Method untuk mendapatkan data jam operasional
    public static function getJamOperasional()
    {
        return static::getByType('jam_operasional');
    }
}
