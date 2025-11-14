@extends('layouts.admin')

@section('content')
<style>
    .kategori-page {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .page-header {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        border: 1px solid rgba(44, 62, 80, 0.05);
    }

    .kategori-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        border: 1px solid rgba(44, 62, 80, 0.05);
        transition: all 0.3s ease;
    }

    .kategori-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.15);
    }

    .kategori-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin-right: 1rem;
    }

    .kategori-info h5 {
        margin: 0;
        color: #2c3e50;
        font-weight: 700;
    }

    .kategori-info p {
        margin: 0.5rem 0 0 0;
        color: #7f8c8d;
        font-size: 0.9rem;
    }

    .kategori-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-edit {
        background: #f39c12;
        border: none;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        background: #e67e22;
        color: white;
        transform: translateY(-2px);
    }

    .btn-delete {
        background: #e74c3c;
        border: none;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        background: #c0392b;
        color: white;
        transform: translateY(-2px);
    }

    .btn-add {
        background: linear-gradient(135deg, #3498db, #2980b9);
        border: none;
        color: white;
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 700;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
    }

    .btn-add:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(52, 152, 219, 0.4);
        color: white;
    }
</style>

<div class="kategori-page">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0">🏷️ Kelola Kategori Galeri</h1>
                    <p class="text-muted mb-0">Atur kategori untuk mengorganisir foto galeri</p>
                </div>
                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addKategoriModal">
                    <i class="fas fa-plus me-2"></i>Tambah Kategori
                </button>
            </div>
        </div>

        <!-- Kategori List -->
        <div class="row">
            @foreach($kategoris as $kategori)
            <div class="col-md-6 col-lg-4">
                <div class="kategori-card">
                    <div class="d-flex align-items-center">
                        <div class="kategori-icon" style="background-color: {{ $kategori->warna }};">
                            <i class="{{ $kategori->icon }}"></i>
                        </div>
                        <div class="kategori-info flex-grow-1">
                            <h5>{{ $kategori->nama }}</h5>
                            <p>{{ $kategori->deskripsi }}</p>
                        </div>
                        <div class="kategori-actions">
                            <button class="btn btn-edit" onclick="editKategori({{ $kategori->id }}, '{{ $kategori->nama }}', '{{ $kategori->deskripsi }}', '{{ $kategori->warna }}', '{{ $kategori->icon }}')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form id="delete-form-{{ $kategori->id }}" method="POST" action="{{ route('admin.galeri.kategori.destroy', $kategori->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button class="btn btn-delete" onclick="deleteKategori({{ $kategori->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($kategoris->count() == 0)
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="fas fa-tags fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada kategori</h4>
                <p class="text-muted">Tambahkan kategori pertama untuk mengorganisir galeri</p>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal Add Kategori -->
<div class="modal fade" id="addKategoriModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.galeri.kategori.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Warna</label>
                        <input type="color" class="form-control form-control-color" name="warna" value="#3498db" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon (FontAwesome)</label>
                        <input type="text" class="form-control" name="icon" placeholder="fas fa-camera" required>
                        <small class="text-muted">Contoh: fas fa-camera, fas fa-star, fas fa-heart</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Kategori -->
<div class="modal fade" id="editKategoriModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editKategoriForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Warna</label>
                        <input type="color" class="form-control form-control-color" id="edit_warna" name="warna" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon (FontAwesome)</label>
                        <input type="text" class="form-control" id="edit_icon" name="icon" required>
                        <small class="text-muted">Contoh: fas fa-camera, fas fa-star, fas fa-heart</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editKategori(id, nama, deskripsi, warna, icon) {
    const form = document.getElementById('editKategoriForm');
    form.action = `/admin/galeri/kategori/${id}`;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_deskripsi').value = deskripsi;
    document.getElementById('edit_warna').value = warna;
    document.getElementById('edit_icon').value = icon;
    new bootstrap.Modal(document.getElementById('editKategoriModal')).show();
}

function deleteKategori(id) {
    if (confirm('Apakah Anda yakin ingin menghapus kategori ini? Foto yang menggunakan kategori ini akan diubah menjadi "Tanpa Kategori".')) {
        const form = document.getElementById(`delete-form-${id}`);
        if (form) form.submit();
    }
}
</script>

@endsection
