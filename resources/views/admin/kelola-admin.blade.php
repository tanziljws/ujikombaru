@extends('layouts.admin')

@section('content')
<style>
    :root {
        --primary-color: #0066cc;
        --primary-dark: #004499;
        --secondary-color: #6c757d;
        --accent-color: #17a2b8;
        --success-color: #28a745;
        --warning-color: #ffc107;
        --danger-color: #dc3545;
        --light-color: #f8f9fa;
        --dark-color: #343a40;
        --text-primary: #2c3e50;
        --text-secondary: #6c757d;
        --border-radius: 12px;
        --shadow: 0 8px 32px rgba(0,0,0,0.1);
        --shadow-hover: 0 12px 40px rgba(0,0,0,0.15);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .admin-page {
        background: #f8f9fa;
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .page-header {
        background: var(--primary-color);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .page-header h1 {
        margin: 0;
        font-weight: 700;
    }

    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: var(--border-radius);
        padding: 1.5rem;
        box-shadow: var(--shadow);
        text-align: center;
        border: 1px solid rgba(0, 102, 204, 0.1);
    }

    .stat-card .icon {
        width: 50px;
        height: 50px;
        background: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 1.25rem;
    }

    .stat-card h3 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .stat-card p {
        color: var(--text-secondary);
        margin: 0;
    }

    .admin-table {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .table-header {
        background: var(--primary-color);
        color: white;
        padding: 1.5rem;
        display: flex;
        justify-content: between;
        align-items: center;
    }

    .table-header h3 {
        margin: 0;
        font-weight: 600;
    }

    .btn-add {
        background: var(--success-color);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
    }

    .btn-add:hover {
        background: #218838;
        color: white;
        text-decoration: none;
    }

    .table {
        margin: 0;
    }

    .table th {
        background: #f8f9fa;
        border: none;
        padding: 1rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .table td {
        border: none;
        padding: 1rem;
        vertical-align: middle;
    }

    .table tbody tr {
        border-bottom: 1px solid #e9ecef;
    }

    .table tbody tr:hover {
        background: #f8f9fa;
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .status-active {
        background: #d4edda;
        color: #155724;
    }

    .status-inactive {
        background: #f8d7da;
        color: #721c24;
    }

    .btn-action {
        padding: 0.375rem 0.75rem;
        border: none;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        margin-right: 0.25rem;
        transition: var(--transition);
    }

    .btn-edit {
        background: var(--warning-color);
        color: white;
    }

    .btn-edit:hover {
        background: #e0a800;
        color: white;
    }

    .btn-delete {
        background: var(--danger-color);
        color: white;
    }

    .btn-delete:hover {
        background: #c82333;
        color: white;
    }

    .btn-toggle {
        background: var(--accent-color);
        color: white;
    }

    .btn-toggle:hover {
        background: #138496;
        color: white;
    }
</style>

<div class="admin-page">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-user-cog me-3"></i>Kelola Admin</h1>
            <p class="mb-0">Manajemen akun administrator SMKN 4 Bogor</p>
        </div>
    </div>

    <div class="container">
        <!-- Statistics Cards -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>{{ $totalAdmins }}</h3>
                <p>Total Admin</p>
            </div>
            <div class="stat-card">
                <div class="icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <h3>{{ $activeAdmins }}</h3>
                <p>Admin Aktif</p>
            </div>
            <div class="stat-card">
                <div class="icon">
                    <i class="fas fa-sign-in-alt"></i>
                </div>
                <h3>{{ $admins->where('last_login', '!=', null)->count() }}</h3>
                <p>Pernah Login</p>
            </div>
        </div>

        <!-- Admin Table -->
        <div class="admin-table">
            <div class="table-header">
                <h3><i class="fas fa-list me-2"></i>Daftar Admin</h3>
                <a href="{{ route('admin.create') }}" class="btn-add">
                    <i class="fas fa-plus me-2"></i>Tambah Admin
                </a>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success m-3">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger m-3">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Terakhir Login</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $admin)
                            <tr>
                                <td>
                                    <strong>{{ $admin->username }}</strong>
                                    @if($admin->id == auth()->guard('admin')->id())
                                        <span class="badge bg-primary ms-2">Anda</span>
                                    @endif
                                </td>
                                <td>{{ $admin->full_name ?? '-' }}</td>
                                <td>{{ $admin->email ?? '-' }}</td>
                                <td>
                                    <span class="status-badge {{ $admin->is_active ? 'status-active' : 'status-inactive' }}">
                                        {{ $admin->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td>
                                    @if($admin->last_login)
                                        {{ $admin->last_login->format('d/m/Y H:i') }}
                                    @else
                                        <span class="text-muted">Belum pernah</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.edit', $admin->id) }}" class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    @if($admin->id != auth()->guard('admin')->id())
                                        <form method="POST" action="{{ route('admin.toggle-status', $admin->id) }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn-action btn-toggle" 
                                                    onclick="return confirm('Yakin ingin {{ $admin->is_active ? 'menonaktifkan' : 'mengaktifkan' }} admin ini?')">
                                                <i class="fas fa-{{ $admin->is_active ? 'ban' : 'check' }}"></i>
                                            </button>
                                        </form>
                                        
                                        <form method="POST" action="{{ route('admin.destroy', $admin->id) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" 
                                                    onclick="return confirm('Yakin ingin menghapus admin ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada admin terdaftar</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
