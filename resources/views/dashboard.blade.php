@extends('layouts.admin')

@section('content')
<style>
    /* Consistent with Homepage Theme */
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

    .dashboard-page {
        background: #f8f9fa;
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    /* Header Banner - Primary Blue */
    .header-banner {
        background: var(--primary-color);
        color: white;
        padding: 2.5rem;
        border-radius: var(--border-radius);
        margin-bottom: 2rem;
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
    }

    .header-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255,255,255,0.1);
        z-index: 1;
    }

    .header-content {
        position: relative;
        z-index: 2;
    }

    .header-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .header-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        font-weight: 500;
    }

    .header-icon {
        font-size: 2rem;
        margin-right: 1rem;
        opacity: 0.9;
    }

    /* Statistics Section */
    .stats-section {
        margin-bottom: 3rem;
    }

    .stats-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .stats-title i {
        color: var(--accent-color);
        font-size: 1.5rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .stat-card {
        background: white;
        border-radius: var(--border-radius);
        padding: 2rem;
        box-shadow: var(--shadow);
        border: 1px solid rgba(0,0,0,0.05);
        transition: var(--transition);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--primary-color);
        transform: scaleX(0);
        transition: var(--transition);
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
        color: white;
        transition: var(--transition);
    }

    .stat-card:hover .stat-icon {
        background: var(--primary-dark);
        color: white;
        transform: scale(1.1);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        line-height: 1;
    }

    .stat-label {
        font-size: 1rem;
        color: var(--text-secondary);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Quick Actions Section */
    .quick-actions {
        background: white;
        border-radius: var(--border-radius);
        padding: 2rem;
        box-shadow: var(--shadow);
        border: 1px solid rgba(0,0,0,0.05);
    }

    .quick-actions h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .quick-actions h3 i {
        color: var(--accent-color);
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .action-card {
        background: white;
        border-radius: var(--border-radius);
        padding: 1.5rem;
        text-align: center;
        transition: var(--transition);
        border: 1px solid rgba(0, 102, 204, 0.1);
        text-decoration: none;
        color: var(--text-primary);
        box-shadow: var(--shadow);
    }

    .action-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-hover);
        background: white;
        color: var(--primary-color);
        text-decoration: none;
    }

    .action-icon {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: var(--primary-color);
        transition: var(--transition);
    }

    .action-card:hover .action-icon {
        transform: scale(1.1);
        color: var(--primary-color);
    }

    .action-title {
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    .action-desc {
        font-size: 0.9rem;
        color: var(--text-secondary);
        line-height: 1.4;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .header-title {
            font-size: 2rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .actions-grid {
            grid-template-columns: 1fr;
        }

        .header-banner {
            padding: 2rem 1.5rem;
        }
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card {
        animation: fadeInUp 0.6s ease forwards;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
    .stat-card:nth-child(5) { animation-delay: 0.5s; }
    .stat-card:nth-child(6) { animation-delay: 0.6s; }
</style>

<div class="dashboard-page">
    <div class="container-fluid">
        <!-- Header Banner -->
        <div class="header-banner">
            <div class="header-content">
                <div class="d-flex align-items-center">
                    <i class="fas fa-shield-alt header-icon"></i>
                    <div>
                        <h1 class="header-title">DASHBOARD ADMIN SMKN 4</h1>
                        <p class="header-subtitle">Panel Kontrol dan Manajemen Sekolah</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- School Statistics -->
        <div class="stats-section">
            <h2 class="stats-title">
                <i class="fas fa-chart-bar"></i>
                Statistik Sekolah
            </h2>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number">1,250</div>
                    <div class="stat-label">Total Siswa</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="stat-number">85</div>
                    <div class="stat-label">Guru & Staff</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="stat-number">4</div>
                    <div class="stat-label">Jurusan</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <div class="stat-number">95%</div>
                    <div class="stat-label">Tingkat Kelulusan</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-images"></i>
                    </div>
                    <div class="stat-number">156</div>
                    <div class="stat-label">Foto di Galeri</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="stat-number">{{ \App\Models\Admin::count() }}</div>
                    <div class="stat-label">Total Admin</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="stat-number">{{ \App\Models\Admin::where('is_active', true)->count() }}</div>
                    <div class="stat-label">Admin Aktif</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-number">12</div>
                    <div class="stat-label">Event Bulan Ini</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h3>
                <i class="fas fa-star"></i>
                AKSI CEPAT ADMIN
            </h3>
            
            <div class="actions-grid">
                <a href="/public/galeri" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-images"></i>
                    </div>
                    <div class="action-title">Kelola Galeri</div>
                    <div class="action-desc">Upload, edit, dan hapus foto galeri sekolah</div>
                </a>

                <a href="/public/informasi" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="action-title">Update Info</div>
                    <div class="action-desc">Edit informasi sekolah dan berita terbaru</div>
                </a>

                <a href="/public/informasi#agenda" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="action-title">Kelola Agenda</div>
                    <div class="action-desc">Atur jadwal kegiatan dan acara sekolah</div>
                </a>

                <a href="{{ route('admin.kelola-admin') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-user-cog"></i>
                    </div>
                    <div class="action-title">Kelola Admin</div>
                    <div class="action-desc">Tambah, edit, dan kelola akun admin</div>
                </a>

                <a href="/" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="action-title">Lihat Website</div>
                    <div class="action-desc">Kunjungi halaman utama website</div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
