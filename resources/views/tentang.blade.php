@extends(session('admin_authenticated') ? 'layouts.admin' : 'layouts.public')

@section('content')
<style>
    :root {
        --primary-color: #2563eb;
        --primary-dark: #1d4ed8;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --light-color: #f8fafc;
        --border-radius: 16px;
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        --space-xl: 2rem;
        --space-2xl: 3rem;
        --font-primary: 'Inter', sans-serif;
        --font-heading: 'Poppins', sans-serif;
    }

    .profil-page {
        background: var(--light-color);
        min-height: 100vh;
        padding: var(--space-2xl) 0;
    }

    .page-header {
        background: white;
        border-radius: var(--border-radius);
        padding: var(--space-2xl);
        margin-bottom: var(--space-2xl);
        box-shadow: var(--shadow-lg);
        text-align: center;
        border-top: 4px solid var(--primary-color);
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 1rem;
    }

    .content-section {
        background: white;
        border-radius: var(--border-radius);
        padding: var(--space-2xl);
        margin-bottom: var(--space-2xl);
        box-shadow: var(--shadow-lg);
    }

    .section-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: var(--space-xl);
        padding-bottom: 1rem;
        border-bottom: 3px solid var(--primary-color);
    }

    .card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        height: 100%;
    }

    .card-header {
        background: var(--primary-color);
        color: white;
        padding: 1.5rem;
        font-weight: 600;
    }

    .card-header h4 {
        color: white;
        margin: 0;
    }
</style>

<div class="profil-page">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">🏫 Profil SMKN 4 Bogor</h1>
            <p class="text-muted">Mengenal lebih dekat tentang sekolah kami</p>
        </div>

        <!-- Tentang SMKN 4 Bogor -->
        <div class="content-section" id="about">
            <h2 class="section-title">Tentang SMKN 4 Bogor</h2>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <p class="lead">SMKN 4 Bogor merupakan sekolah kejuruan yang berfokus pada pengembangan teknologi dan karakter siswa.</p>
                    <p>Dengan fasilitas modern dan tenaga pengajar yang berpengalaman, kami berkomitmen untuk menghasilkan lulusan yang siap menghadapi tantangan dunia kerja di era digital.</p>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle text-primary me-3"></i>
                                <span>Fasilitas Modern</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle text-primary me-3"></i>
                                <span>Guru Berpengalaman</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle text-primary me-3"></i>
                                <span>Kurikulum Terkini</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle text-primary me-3"></i>
                                <span>Lingkungan Kondusif</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('images/4.JPG') }}" alt="SMKN 4 Bogor" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>

        <!-- Visi Misi -->
        <div class="content-section" id="vision-mission">
            <h2 class="section-title">Visi & Misi</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-eye me-2"></i>Visi</h4>
                        </div>
                        <div class="card-body">
                            <p>Menjadi sekolah kejuruan terdepan yang menghasilkan lulusan berkarakter, kompeten, dan siap menghadapi tantangan global di era digital.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-bullseye me-2"></i>Misi</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success me-2"></i>Menyelenggarakan pendidikan berkualitas tinggi</li>
                                <li><i class="fas fa-check text-success me-2"></i>Mengembangkan kurikulum berbasis industri</li>
                                <li><i class="fas fa-check text-success me-2"></i>Membentuk karakter siswa yang berintegritas</li>
                                <li><i class="fas fa-check text-success me-2"></i>Menyediakan fasilitas pembelajaran modern</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="/" class="btn btn-primary btn-lg">
                <i class="fas fa-home me-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection