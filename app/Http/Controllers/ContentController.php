<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\InformasiSekolah;
use App\Models\Agenda;

class ContentController extends Controller
{
    public function updateAgenda(Request $request)
    {
        // Hanya admin yang bisa akses
        if (!session('admin_authenticated')) {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $request->validate([
            'agenda' => 'required|array',
            'agenda.*.tanggal' => 'required|date',
            'agenda.*.judul' => 'required|string|max:255',
            'agenda.*.deskripsi' => 'nullable|string',
        ]);

        // Simpan ke database: kosongkan dan masukkan ulang sesuai urutan
        Agenda::truncate();
        foreach ($request->agenda as $index => $item) {
            Agenda::create([
                'tanggal' => $item['tanggal'],
                'judul' => $item['judul'],
                'deskripsi' => $item['deskripsi'] ?? null,
                'order' => $index + 1,
            ]);
        }

        // Simpan juga ke session agar halaman yang sama langsung merefleksikan perubahan
        session(['agenda_data' => $request->agenda]);

        return redirect()->back()->with('success', 'Agenda berhasil diupdate!');
    }

    public function updateInformasi(Request $request)
    {
        // Hanya admin yang bisa akses
        if (!session('admin_authenticated')) {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $request->validate([
            'jurusan' => 'required|array',
            'jurusan.*' => 'required|string|max:255',
            'akreditasi' => 'required|array',
            'akreditasi.*' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'required|string|max:255',
        ]);

        // Update data jurusan
        InformasiSekolah::where('type', 'jurusan')->delete();
        foreach ($request->jurusan as $index => $jurusan) {
            if (!empty(trim($jurusan))) {
                InformasiSekolah::create([
                    'type' => 'jurusan',
                    'key' => 'jurusan_' . ($index + 1),
                    'value' => $jurusan,
                    'order' => $index + 1
                ]);
            }
        }

        // Update data akreditasi
        InformasiSekolah::where('type', 'akreditasi')->delete();
        foreach ($request->akreditasi as $index => $akreditasi) {
            if (!empty(trim($akreditasi))) {
                InformasiSekolah::create([
                    'type' => 'akreditasi',
                    'key' => 'akreditasi_' . ($index + 1),
                    'value' => $akreditasi,
                    'order' => $index + 1
                ]);
            }
        }



        return redirect()->back()->with('success', 'Informasi sekolah berhasil diupdate!');
    }
    
    public function addJurusan(Request $request)
    {
        if (!session('admin_authenticated')) {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $request->validate([
            'jurusan' => 'required|string|max:255',
        ]);

        $order = InformasiSekolah::where('type', 'jurusan')->max('order') + 1;
        
        InformasiSekolah::create([
            'type' => 'jurusan',
            'key' => 'jurusan_' . $order,
            'value' => $request->jurusan,
            'order' => $order
        ]);

        return redirect()->back()->with('success', 'Jurusan berhasil ditambahkan!');
    }
    
    public function deleteJurusan($id)
    {
        if (!session('admin_authenticated')) {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $jurusan = InformasiSekolah::findOrFail($id);
        if ($jurusan->type === 'jurusan') {
            $jurusan->delete();
            return redirect()->back()->with('success', 'Jurusan berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Data tidak valid!');
    }
    
    public function addAkreditasi(Request $request)
    {
        if (!session('admin_authenticated')) {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $request->validate([
            'akreditasi' => 'required|string|max:255',
        ]);

        $order = InformasiSekolah::where('type', 'akreditasi')->max('order') + 1;
        
        InformasiSekolah::create([
            'type' => 'akreditasi',
            'key' => 'akreditasi_' . $order,
            'value' => $request->akreditasi,
            'order' => $order
        ]);

        return redirect()->back()->with('success', 'Akreditasi berhasil ditambahkan!');
    }
    
    public function deleteAkreditasi($id)
    {
        if (!session('admin_authenticated')) {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $akreditasi = InformasiSekolah::findOrFail($id);
        if ($akreditasi->type === 'akreditasi') {
            $akreditasi->delete();
            return redirect()->back()->with('success', 'Akreditasi berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Data tidak valid!');
    }
}
