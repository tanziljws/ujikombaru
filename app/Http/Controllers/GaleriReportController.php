<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Models\GaleriKategori;
use App\Models\GaleriLike;
use App\Models\GaleriComment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class GaleriReportController extends Controller
{
    /**
     * Tampilkan halaman laporan statistik galeri
     */
    public function index(Request $request)
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login sebagai admin terlebih dahulu.');
        }

        // Default: tampilkan semua data dari awal sampai sekarang
        $dateFrom = $request->get('date_from', '2020-01-01'); // Dari tahun 2020 (bisa disesuaikan)
        $dateTo = $request->get('date_to', now()->format('Y-m-d'));
        $kategoriId = $request->get('kategori_id', null);

        $statistics = $this->getStatistics($dateFrom, $dateTo, $kategoriId);

        return view('admin.galeri.report', compact('statistics', 'dateFrom', 'dateTo', 'kategoriId'));
    }

    /**
     * Generate laporan PDF
     */
    public function generatePDF(Request $request)
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login sebagai admin terlebih dahulu.');
        }

        // Default: tampilkan semua data dari awal sampai sekarang
        $dateFrom = $request->get('date_from', '2020-01-01'); // Dari tahun 2020 (bisa disesuaikan)
        $dateTo = $request->get('date_to', now()->format('Y-m-d'));
        $kategoriId = $request->get('kategori_id', null);

        $statistics = $this->getStatistics($dateFrom, $dateTo, $kategoriId);

        $pdf = PDF::loadView('admin.galeri.report-pdf', compact('statistics', 'dateFrom', 'dateTo'));
        
        $filename = 'laporan-galeri-' . date('Y-m-d-His') . '.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Dapatkan statistik galeri
     */
    private function getStatistics($dateFrom, $dateTo, $kategoriId = null)
    {
        // Base query filter untuk galeri
        $baseFilter = function($query) {
            $query->where('gambar', 'not like', '%logo%')
                  ->where('gambar', 'not like', '%jurusan%')
                  ->where('judul', 'not like', '%logo%')
                  ->where('judul', 'not like', '%smk%')
                  ->where('judul', 'not like', '%pplg%')
                  ->where('judul', 'not like', '%tkj%')
                  ->where('judul', 'not like', '%tpfl%')
                  ->where('judul', 'not like', '% to %')
                  ->where('judul', '!=', 'To')
                  ->where('judul', '!=', 'TO');
        };

        // Total galeri - build fresh query
        $totalGaleri = Galeri::where($baseFilter)
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->when($kategoriId, function($q) use ($kategoriId) {
                return $q->where('kategori_id', $kategoriId);
            })
            ->count();

        // Total views - build fresh query
        $totalViews = Galeri::where($baseFilter)
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->when($kategoriId, function($q) use ($kategoriId) {
                return $q->where('kategori_id', $kategoriId);
            })
            ->sum('views');

        // Total likes - build fresh query
        $totalLikes = Galeri::where($baseFilter)
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->when($kategoriId, function($q) use ($kategoriId) {
                return $q->where('kategori_id', $kategoriId);
            })
            ->sum('likes');

        // Total dislikes - build fresh query
        $totalDislikes = Galeri::where($baseFilter)
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->when($kategoriId, function($q) use ($kategoriId) {
                return $q->where('kategori_id', $kategoriId);
            })
            ->sum('dislikes');

        // Total comments - build fresh query
        $galeriIds = Galeri::where($baseFilter)
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->when($kategoriId, function($q) use ($kategoriId) {
                return $q->where('kategori_id', $kategoriId);
            })
            ->pluck('id');
        $totalComments = GaleriComment::whereIn('galeri_id', $galeriIds)->count();

        // Aktivitas Like & Komentar terbaru (menampilkan siapa saja)
        $recentLikes = GaleriLike::with(['user', 'galeri.kategori'])
            ->where('type', 'like')
            ->whereIn('galeri_id', $galeriIds)
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        $recentComments = GaleriComment::with(['user', 'galeri.kategori'])
            ->whereIn('galeri_id', $galeriIds)
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        // Galeri per kategori
        $galeriPerKategori = Galeri::select('kategori_id', DB::raw('count(*) as total'))
            ->where($baseFilter)
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->when($kategoriId, function($q) use ($kategoriId) {
                return $q->where('kategori_id', $kategoriId);
            })
            ->groupBy('kategori_id')
            ->with('kategori')
            ->get();

        // Top 10 galeri berdasarkan views
        $topViewed = Galeri::with('kategori')
            ->where($baseFilter)
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->when($kategoriId, function($q) use ($kategoriId) {
                return $q->where('kategori_id', $kategoriId);
            })
            ->orderBy('views', 'desc')
            ->limit(10)
            ->get();

        // Top 10 galeri berdasarkan likes
        $topLiked = Galeri::with('kategori')
            ->where($baseFilter)
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->when($kategoriId, function($q) use ($kategoriId) {
                return $q->where('kategori_id', $kategoriId);
            })
            ->orderBy('likes', 'desc')
            ->limit(10)
            ->get();

        // Top 10 galeri berdasarkan comments
        $topCommented = Galeri::with(['kategori', 'galeriComments'])
            ->where($baseFilter)
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->when($kategoriId, function($q) use ($kategoriId) {
                return $q->where('kategori_id', $kategoriId);
            })
            ->withCount('galeriComments')
            ->orderBy('galeri_comments_count', 'desc')
            ->limit(10)
            ->get();

        // List semua kategori untuk filter
        $kategoris = GaleriKategori::orderBy('nama')->get();

        // Engagement rate (average likes per galeri)
        $avgLikes = $totalGaleri > 0 ? round($totalLikes / $totalGaleri, 2) : 0;
        $avgViews = $totalGaleri > 0 ? round($totalViews / $totalGaleri, 2) : 0;
        $avgComments = $totalGaleri > 0 ? round($totalComments / $totalGaleri, 2) : 0;

        return [
            'totalGaleri' => $totalGaleri,
            'totalViews' => $totalViews,
            'totalLikes' => $totalLikes,
            'totalDislikes' => $totalDislikes,
            'totalComments' => $totalComments,
            'avgLikes' => $avgLikes,
            'avgViews' => $avgViews,
            'avgComments' => $avgComments,
            'galeriPerKategori' => $galeriPerKategori,
            'topViewed' => $topViewed,
            'topLiked' => $topLiked,
            'topCommented' => $topCommented,
            'kategoris' => $kategoris,
            'recentLikes' => $recentLikes,
            'recentComments' => $recentComments,
        ];
    }
}
