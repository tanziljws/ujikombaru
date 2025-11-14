<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InformasiSekolah;

class InformasiSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama
        InformasiSekolah::truncate();
        
        // Data Jurusan
        $jurusan = [
            '💻 Pengembangan Perangkat Lunak dan Gim (PPLG)',
            '🖥️ Teknik Jaringan dan Komputer (TKJ)',
            '🚗 Teknik Otomotif (TO)',
            '🔧 Teknik Pengelasan dan Fabrikasi Logam (TPFL)'
        ];
        
        foreach ($jurusan as $index => $j) {
            InformasiSekolah::create([
                'type' => 'jurusan',
                'key' => 'jurusan_' . ($index + 1),
                'value' => $j,
                'order' => $index + 1
            ]);
        }
        
        // Data Akreditasi
        $akreditasi = [
            '🏆 PPLG: A (Unggul)',
            '🏆 TKJ: A (Unggul)',
            '🏆 TO: A (Unggul)',
            '🏆 TPFL: A (Unggul)'
        ];
        
        foreach ($akreditasi as $index => $a) {
            InformasiSekolah::create([
                'type' => 'akreditasi',
                'key' => 'akreditasi_' . ($index + 1),
                'value' => $a,
                'order' => $index + 1
            ]);
        }
        
        // Data Kontak
        $kontak = [
            'alamat' => 'Jl. Pendidikan No. 123, Kota, Provinsi 12345',
            'telepon' => '(021) 1234-5678',
            'email' => 'info@smkn4.sch.id',
            'website' => 'www.smkn4.sch.id'
        ];
        
        foreach ($kontak as $key => $value) {
            InformasiSekolah::create([
                'type' => 'kontak',
                'key' => $key,
                'value' => $value,
                'order' => 0
            ]);
        }
        
        // Data Jam Operasional
        $jamOperasional = [
            'Senin - Jumat' => '07:00 - 15:00',
            'Sabtu' => '07:00 - 12:00',
            'Minggu' => 'Libur'
        ];
        
        foreach ($jamOperasional as $hari => $jam) {
            InformasiSekolah::create([
                'type' => 'jam_operasional',
                'key' => strtolower(str_replace(' ', '_', $hari)),
                'value' => $hari . ': ' . $jam,
                'order' => 0
            ]);
        }
    }
}
