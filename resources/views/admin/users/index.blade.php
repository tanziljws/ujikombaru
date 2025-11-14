@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header mb-4">
                <h2><i class="fas fa-users me-2"></i>Data User Terdaftar</h2>
                <p class="text-muted">Daftar semua user yang sudah mendaftar di sistem</p>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>NISN</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if($user->photo)
                                            <img src="{{ asset($user->photo) }}" alt="{{ $user->name }}" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td><strong>{{ $user->name }}</strong></td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="badge bg-info">{{ $user->nisn }}</span></td>
                                    <td>{{ $user->created_at->format('d M Y, H:i') }}</td>
                                    <td>
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>Aktif
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="fas fa-users fa-3x text-muted mb-3 d-block"></i>
                                        <p class="text-muted">Belum ada user yang terdaftar</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        <p class="text-muted mb-0">
                            <i class="fas fa-info-circle me-1"></i>
                            Total: <strong>{{ $users->count() }}</strong> user terdaftar
                        </p>
                    </div>
                </div>
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

.table th {
    background-color: var(--primary-color);
    color: white;
    font-weight: 600;
    border: none;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 102, 204, 0.05);
}

.card {
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border-radius: 12px;
}
</style>
@endsection
