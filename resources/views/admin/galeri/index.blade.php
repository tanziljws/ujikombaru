@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h2>📸 Manajemen Galeri Sekolah</h2>
                <p class="text-muted">Kelola semua foto galeri sekolah</p>
            </div>

            <!-- Pesan sukses -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Statistik Galeri -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-images"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $galeriUmum->count() }}</h3>
                            <p>Total Foto</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: #17a2b8;">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ number_format($galeriUmum->sum('views')) }}</h3>
                            <p>Total Views</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: #28a745;">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ number_format($galeriUmum->sum('likes')) }}</h3>
                            <p>Total Likes</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: #ffc107;">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ number_format($galeriUmum->sum(function($item) { return $item->galeriComments->count(); })) }}</h3>
                            <p>Total Komentar</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Tambah -->
            <div class="mb-4">
                <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Foto Baru
                </a>
            </div>

            <!-- Section Galeri Umum -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-images me-2"></i>Galeri Umum Sekolah
                    </h5>
                </div>
                <div class="card-body">
                    @if($galeriUmum->count() > 0)
                        <div class="row">
                            @foreach($galeriUmum as $foto)
                            <div class="col-md-4 col-lg-3 mb-3">
                                <div class="photo-card">
                                    <div class="photo-image">
                                        <img src="{{ asset($foto->gambar) }}" alt="{{ $foto->judul }}" class="img-fluid">
                                    </div>
                                    <div class="photo-info">
                                        <h6 class="photo-title">{{ $foto->judul }}</h6>
                                        @if($foto->deskripsi)
                                            <p class="photo-description">{{ Str::limit($foto->deskripsi, 50) }}</p>
                                        @endif
                                        <small class="text-muted">Ditambahkan: {{ $foto->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                    <div class="photo-actions">
                                        <a href="{{ route('admin.galeri.edit', $foto->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.galeri.destroy', $foto->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus foto ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-images fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada foto galeri umum yang ditambahkan.</p>
                        </div>
                    @endif
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

.photo-card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s;
    background: white;
    display: flex; flex-direction: column; height: 100%;}

.photo-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.photo-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.photo-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.photo-info {
    padding: 15px;
    flex: 1; display: flex; flex-direction: column; min-height: 100px;}

.photo-title {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 5px;
    color: #333;
}

.photo-description {
    font-size: 12px;
    color: #666;
    margin-bottom: 8px;
    flex: 1;}

.photo-actions {
    padding: 10px 15px 15px;
    display: flex;
    gap: 5px;
}

.photo-actions .btn {
    flex: 1;
    font-size: 12px;
}

.page-header {
    margin-bottom: 30px;
    text-align: center;
}

.page-header h2 {
    color: var(--dark-color);
    font-weight: 700;
    margin-bottom: 5px;
}
</style>
@endsection
