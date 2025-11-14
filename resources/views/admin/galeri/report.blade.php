@extends('layouts.admin')

@section('title', 'Laporan Statistik Galeri')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1"><i class="bi bi-bar-chart-line me-2"></i>Laporan Statistik Galeri</h2>
                    <p class="text-muted mb-0">Analisis performa dan interaksi galeri sekolah</p>
                </div>
                <a href="{{ route('admin.galeri') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Galeri
                </a>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-funnel me-2"></i>Filter Laporan</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.galeri.report') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="date_from" class="form-label">Dari Tanggal</label>
                    <input type="date" class="form-control" id="date_from" name="date_from" value="{{ $dateFrom }}">
                </div>
                <div class="col-md-4">
                    <label for="date_to" class="form-label">Sampai Tanggal</label>
                    <input type="date" class="form-control" id="date_to" name="date_to" value="{{ $dateTo }}">
                </div>
                <div class="col-md-4">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori_id" name="kategori_id">
                        <option value="">Semua Kategori</option>
                        @foreach($statistics['kategoris'] as $kat)
                            <option value="{{ $kat->id }}" {{ $kategoriId == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search me-2"></i>Filter
                    </button>
                    <a href="{{ route('admin.galeri.report.pdf', request()->query()) }}" class="btn btn-danger" target="_blank">
                        <i class="bi bi-file-pdf me-2"></i>Export PDF
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: #0066cc;">
                    <i class="fas fa-images"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ number_format($statistics['totalGaleri']) }}</h3>
                    <p>Total Foto</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: #17a2b8;">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ number_format($statistics['totalViews']) }}</h3>
                    <p>Total Views</p>
                    <small class="text-muted">Rata-rata: {{ number_format($statistics['avgViews'], 1) }}/foto</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: #28a745;">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ number_format($statistics['totalLikes']) }}</h3>
                    <p>Total Likes</p>
                    <small class="text-muted">Rata-rata: {{ number_format($statistics['avgLikes'], 1) }}/foto</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: #ffc107;">
                    <i class="fas fa-comments"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ number_format($statistics['totalComments']) }}</h3>
                    <p>Total Komentar</p>
                    <small class="text-muted">Rata-rata: {{ number_format($statistics['avgComments'], 1) }}/foto</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Galeri per Kategori -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0"><i class="bi bi-pie-chart me-2"></i>Distribusi Galeri per Kategori</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Kategori</th>
                            <th class="text-center">Jumlah Foto</th>
                            <th class="text-center">Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($statistics['galeriPerKategori'] as $item)
                        <tr>
                            <td>
                                <span class="badge" style="background-color: {{ $item->kategori->warna ?? '#6c757d' }}">
                                    <i class="{{ $item->kategori->icon ?? 'bi bi-folder' }} me-1"></i>
                                    {{ $item->kategori->nama ?? 'Tanpa Kategori' }}
                                </span>
                            </td>
                            <td class="text-center">{{ $item->total }}</td>
                            <td class="text-center">
                                {{ $statistics['totalGaleri'] > 0 ? number_format(($item->total / $statistics['totalGaleri']) * 100, 1) : 0 }}%
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Top 10 Tables -->
    <div class="row">
        <!-- Top Viewed -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="bi bi-eye me-2"></i>Top 10 Paling Dilihat</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($statistics['topViewed'] as $index => $galeri)
                        <div class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="badge bg-info me-2">{{ $index + 1 }}</div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold text-truncate" style="max-width: 200px;">{{ $galeri->judul }}</div>
                                    <small class="text-muted">{{ $galeri->kategori->nama ?? 'Tanpa Kategori' }}</small>
                                </div>
                                <span class="badge bg-light text-dark">{{ number_format($galeri->views) }}</span>
                            </div>
                        </div>
                        @empty
                        <div class="list-group-item text-center text-muted">Tidak ada data</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Liked -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0"><i class="bi bi-heart-fill me-2"></i>Top 10 Paling Disukai</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($statistics['topLiked'] as $index => $galeri)
                        <div class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="badge bg-success me-2">{{ $index + 1 }}</div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold text-truncate" style="max-width: 200px;">{{ $galeri->judul }}</div>
                                    <small class="text-muted">{{ $galeri->kategori->nama ?? 'Tanpa Kategori' }}</small>
                                </div>
                                <span class="badge bg-light text-dark">{{ number_format($galeri->likes) }}</span>
                            </div>
                        </div>
                        @empty
                        <div class="list-group-item text-center text-muted">Tidak ada data</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Commented -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0"><i class="bi bi-chat-dots me-2"></i>Top 10 Paling Banyak Komentar</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($statistics['topCommented'] as $index => $galeri)
                        <div class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="badge bg-warning text-dark me-2">{{ $index + 1 }}</div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold text-truncate" style="max-width: 200px;">{{ $galeri->judul }}</div>
                                    <small class="text-muted">{{ $galeri->kategori->nama ?? 'Tanpa Kategori' }}</small>
                                </div>
                                <span class="badge bg-light text-dark">{{ number_format($galeri->galeri_comments_count) }}</span>
                            </div>
                        </div>
                        @empty
                        <div class="list-group-item text-center text-muted">Tidak ada data</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0"><i class="bi bi-hand-thumbs-up me-2"></i>Aktivitas Like Terbaru</h6>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($statistics['recentLikes'] as $like)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-bold">{{ $like->user->name ?? 'Pengguna' }}</div>
                            <small class="text-muted">Menyukai: {{ $like->galeri->judul ?? 'Foto' }} • {{ $like->galeri->kategori->nama ?? 'Tanpa Kategori' }}</small>
                        </div>
                        <small class="text-muted">{{ optional($like->created_at)->format('d M Y H:i') }}</small>
                    </div>
                    @empty
                    <div class="list-group-item text-center text-muted">Tidak ada aktivitas</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-warning text-dark">
                <h6 class="mb-0"><i class="bi bi-chat-dots me-2"></i>Komentar Terbaru</h6>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($statistics['recentComments'] as $c)
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fw-bold">{{ $c->user->name ?? 'Pengguna' }}</div>
                                <small class="text-muted">Pada: {{ $c->galeri->judul ?? 'Foto' }} • {{ $c->galeri->kategori->nama ?? 'Tanpa Kategori' }}</small>
                                <div class="text-muted mt-1">{{ Str::limit($c->comment, 120) }}</div>
                            </div>
                            <small class="text-muted">{{ optional($c->created_at)->format('d M Y H:i') }}</small>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item text-center text-muted">Tidak ada komentar</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.stat-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: transform 0.3s, box-shadow 0.3s;
    border: 1px solid #e0e0e0;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
}

.stat-icon {
    width: 60px;
    height: 60px;
    background: #0066cc;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: white;
}

.stat-info {
    flex: 1;
}

.stat-info h3 {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    color: #333;
}

.stat-info p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
    font-weight: 500;
}

.stat-info small {
    display: block;
    margin-top: 0.25rem;
}

.card {
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-2px);
}
</style>
@endsection
