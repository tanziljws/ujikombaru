@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header mb-4">
                <h2><i class="fas fa-images me-2"></i>Kelola Galeri Publik</h2>
                <p class="text-muted">Kelola foto galeri yang ditampilkan di halaman publik</p>
            </div>

            <!-- Tombol Tambah -->
            <div class="mb-4">
                <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Foto Baru
                </a>
            </div>

            <!-- Galeri Grid -->
            <div class="row">
                @forelse($galeri as $item)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset($item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title">{{ $item->judul }}</h6>
                            <p class="card-text small text-muted">{{ Str::limit($item->deskripsi, 50) }}</p>
                            <div class="d-flex gap-2 mt-2">
                                <span class="badge bg-info"><i class="fas fa-eye me-1"></i>{{ $item->views ?? 0 }}</span>
                                <span class="badge bg-success"><i class="fas fa-thumbs-up me-1"></i>{{ $item->likes ?? 0 }}</span>
                                <span class="badge bg-danger"><i class="fas fa-thumbs-down me-1"></i>{{ $item->dislikes ?? 0 }}</span>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.galeri.edit', $item->id) }}" class="btn btn-sm btn-warning flex-fill">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" class="flex-fill">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Yakin hapus?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-images fa-4x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada foto galeri</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
.page-header {
    text-align: center;
}

.page-header h2 {
    color: var(--dark-color);
    font-weight: 700;
}

.card {
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border-radius: 12px;
    transition: transform 0.3s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}
</style>
@endsection
