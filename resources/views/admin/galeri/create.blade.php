@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-plus me-2"></i>Tambah Foto Baru
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Foto <span class="text-danger">*</span></label>
                            <input type="text" name="judul" id="judul" class="form-control" required 
                                   placeholder="Masukkan judul foto">
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" 
                                      placeholder="Masukkan deskripsi foto (opsional)"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori_id" id="kategori_id" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                            <div class="form-text">Pilih kategori untuk foto ini</div>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">File Foto <span class="text-danger">*</span></label>
                            <input type="file" name="gambar" id="gambar" class="form-control" required 
                                   accept="image/*">
                            <div class="form-text">Format yang didukung: JPG, PNG, GIF. Maksimal 2MB.</div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Foto
                            </button>
                            <a href="{{ route('admin.galeri') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-label {
    font-weight: 600;
    color: var(--dark-color);
}

.form-control, .form-select {
    border-radius: 0.5rem;
    border: 1px solid var(--border-color);
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.form-text {
    font-size: 12px;
    color: var(--text-muted);
}
</style>
@endsection
