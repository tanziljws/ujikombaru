<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $news = [
            [
                'judul' => 'Prestasi Siswa di Kompetisi Nasional',
                'deskripsi' => 'SMKN 4 berhasil meraih juara 1 dalam kompetisi programming nasional yang diselenggarakan di Jakarta. Tim TKJ berhasil mengalahkan 50 tim dari seluruh Indonesia.',
                'tanggal' => '2024-12-12',
                'status' => 'published',
            ],
            [
                'judul' => 'Renovasi Laboratorium Komputer',
                'deskripsi' => 'Laboratorium komputer sedang dalam proses renovasi untuk meningkatkan kualitas pembelajaran. Renovasi diperkirakan selesai dalam 2 minggu ke depan.',
                'tanggal' => '2024-12-10',
                'status' => 'published',
            ],
            [
                'judul' => 'Pendaftaran Siswa Baru 2025',
                'deskripsi' => 'Pendaftaran siswa baru untuk tahun ajaran 2025/2026 akan dibuka pada bulan Januari 2025. Informasi lengkap dapat dilihat di website resmi sekolah.',
                'tanggal' => '2024-12-08',
                'status' => 'published',
            ],
        ];

        foreach ($news as $item) {
            News::create($item);
        }
    }
}
