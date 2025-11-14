<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('tanggal', 'desc')->get();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        if (!session('admin_authenticated')) {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'tanggal' => 'required|date',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'tanggal', 'status']);

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
            $data['gambar'] = 'images/' . $imageName;
        }

        News::create($data);

        return redirect()->route('informasi.public')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_authenticated')) {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'tanggal' => 'required|date',
            'status' => 'required|in:draft,published',
        ]);

        $news = News::findOrFail($id);
        $data = $request->only(['judul', 'deskripsi', 'tanggal', 'status']);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($news->gambar && file_exists(public_path($news->gambar))) {
                unlink(public_path($news->gambar));
            }
            
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
            $data['gambar'] = 'images/' . $imageName;
        }

        $news->update($data);

        return redirect()->route('informasi.public')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (!session('admin_authenticated')) {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $news = News::findOrFail($id);

        // Hapus file gambar jika ada
        if ($news->gambar && file_exists(public_path($news->gambar))) {
            unlink(public_path($news->gambar));
        }

        $news->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus!');
    }
}
