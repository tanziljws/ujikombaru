<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GaleriKategori;

class GaleriKategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            [
                'nama' => 'Acara Sekolah',
                'deskripsi' => 'Foto acara-acara penting sekolah seperti upacara, perayaan, dan event',
                'warna' => '#dc3545',
                'icon' => 'fas fa-calendar-alt',
            ],
            [
                'nama' => 'Ekstrakurikuler',
                'deskripsi' => 'Foto kegiatan ekstrakurikuler seperti olahraga, seni, dan organisasi siswa',
                'warna' => '#ffc107',
                'icon' => 'fas fa-futbol',
            ],
            [
                'nama' => 'Kegiatan Belajar',
                'deskripsi' => 'Foto kegiatan pembelajaran di kelas, laboratorium, dan praktik kejuruan',
                'warna' => '#28a745',
                'icon' => 'fas fa-chalkboard-teacher',
            ],
            [
                'nama' => 'Prestasi',
                'deskripsi' => 'Foto prestasi dan pencapaian siswa di berbagai bidang',
                'warna' => '#6f42c1',
                'icon' => 'fas fa-trophy',
            ],
        ];

        foreach ($kategoris as $kategori) {
            GaleriKategori::create($kategori);
        }
    }
}
