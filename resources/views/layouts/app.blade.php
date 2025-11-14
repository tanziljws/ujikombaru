<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>SMKN 4 - Galeri Sekolah</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts: Modern Font Pairing -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Modern Color Palette */
            --primary-color: #2563eb;      /* Modern blue */
            --primary-dark: #1d4ed8;      /* Darker blue */
            --primary-light: #3b82f6;     /* Lighter blue */
            --secondary-color: #64748b;    /* Slate gray */
            --accent-color: #7c3aed;      /* Purple accent */
            --success-color: #059669;     /* Green */
            --warning-color: #d97706;     /* Amber */
            --danger-color: #dc2626;      /* Red */
            --info-color: #0891b2;        /* Cyan */
            
            /* Neutral Colors */
            --light-color: #f8fafc;       /* Light background */
            --dark-color: #0f172a;        /* Dark text */
            --white-color: #ffffff;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            
            /* Typography */
            --font-primary: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --font-heading: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            
            /* Spacing Scale */
            --space-xs: 0.25rem;    /* 4px */
            --space-sm: 0.5rem;     /* 8px */
            --space-md: 1rem;       /* 16px */
            --space-lg: 1.5rem;     /* 24px */
            --space-xl: 2rem;       /* 32px */
            --space-2xl: 3rem;      /* 48px */
            --space-3xl: 4rem;      /* 64px */
            
            /* Border Radius */
            --radius-sm: 0.375rem;   /* 6px */
            --radius-md: 0.5rem;    /* 8px */
            --radius-lg: 0.75rem;   /* 12px */
            --radius-xl: 1rem;      /* 16px */
            --radius-2xl: 1.5rem;   /* 24px */
            
            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            
            /* Transitions */
            --transition-fast: 150ms ease-in-out;
            --transition-normal: 300ms ease-in-out;
            --transition-slow: 500ms ease-in-out;
        }
        html {
            scroll-behavior: smooth;
        }
        
        /* Ensure anchor scrolling works properly */
        #agenda, #berita, #jurusan {
            scroll-margin-top: 100px;
        }
        
        body {
            display: flex;
            min-height: 100vh;
            font-family: var(--font-primary);
            font-size: 1rem;
            line-height: 1.6;
            margin: 0;
            background-color: var(--light-color);
            color: var(--dark-color);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Typography Hierarchy */
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            font-weight: 600;
            line-height: 1.2;
            color: var(--dark-color);
            margin-bottom: var(--space-md);
        }
        
        h1 { font-size: 2.5rem; font-weight: 700; }
        h2 { font-size: 2rem; font-weight: 600; }
        h3 { font-size: 1.75rem; font-weight: 600; }
        h4 { font-size: 1.5rem; font-weight: 500; }
        h5 { font-size: 1.25rem; font-weight: 500; }
        h6 { font-size: 1.125rem; font-weight: 500; }
        
        p {
            margin-bottom: var(--space-md);
            color: var(--gray-600);
        }
        
        .text-muted {
            color: var(--gray-500) !important;
        }
        
        .text-primary {
            color: var(--primary-color) !important;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            padding: 0;
            border-right: 1px solid var(--gray-200);
            box-shadow: var(--shadow-lg);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: var(--transition-normal);
        }

        .sidebar-header {
            padding: var(--space-2xl) var(--space-lg);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
        }

        .sidebar h4 {
            font-family: var(--font-heading);
            font-weight: 700;
            margin: 0;
            color: var(--white-color) !important;
            font-size: 1.5rem;
            letter-spacing: -0.025em;
        }

        .sidebar-nav {
            padding: var(--space-lg) 0;
        }

        .sidebar a {
            display: block;
            padding: var(--space-md) var(--space-lg);
            color: rgba(255, 255, 255, 0.8) !important;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: var(--transition-normal);
            border-left: 3px solid transparent;
            border-radius: 0 var(--radius-md) var(--radius-md) 0;
            margin: var(--space-xs) var(--space-md);
            position: relative;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1) !important;
            color: var(--white-color) !important;
            border-left-color: rgba(255, 255, 255, 0.5) !important;
            transform: translateX(4px);
        }

        .sidebar a.active {
            background: rgba(255, 255, 255, 0.15) !important;
            color: var(--white-color) !important;
            border-left-color: var(--white-color) !important;
            font-weight: 600;
            box-shadow: var(--shadow-md);
        }

        .sidebar .user-section {
            padding: var(--space-lg);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
        }

        .user-info {
            padding: var(--space-md);
            background: rgba(255, 255, 255, 0.1) !important;
            border-radius: var(--radius-lg);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: var(--space-md);
            backdrop-filter: blur(10px);
        }

        .user-info small {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .logout-btn {
            width: 100%;
            padding: var(--space-md);
            background: rgba(220, 38, 38, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.3);
            border-radius: var(--radius-md);
            color: #fca5a5;
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition-normal);
            backdrop-filter: blur(10px);
        }

        .logout-btn:hover {
            background: var(--danger-color);
            border-color: var(--danger-color);
            color: var(--white-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .main-content {
            flex-grow: 1;
            margin-left: 280px;
            padding: var(--space-2xl);
            background-color: var(--light-color);
            min-height: 100vh;
            transition: var(--transition-normal);
        }

        .page-header {
            margin-bottom: var(--space-2xl);
        }

        .page-header h2 {
            font-family: var(--font-heading);
            font-weight: 700;
            color: var(--dark-color);
            margin: 0;
            font-size: 2.25rem;
            letter-spacing: -0.025em;
        }

        .card {
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow);
            background-color: var(--white-color);
            margin-bottom: var(--space-lg);
            height: fit-content;
            transition: var(--transition-normal);
            overflow: hidden;
        }

        .card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%) !important;
            border-bottom: 1px solid var(--gray-200);
            padding: var(--space-lg) var(--space-xl);
            border-radius: var(--radius-xl) var(--radius-xl) 0 0;
        }

        .card-header h5 {
            font-family: var(--font-heading);
            font-weight: 600;
            color: var(--white-color) !important;
            margin: 0;
            font-size: 1.125rem;
        }

        .card-body {
            padding: var(--space-xl);
        }

        /* Grid Layout untuk konten */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .content-grid.full-width {
            grid-template-columns: 1fr;
        }

        .content-grid.three-columns {
            grid-template-columns: 1fr 1fr 1fr;
        }

        /* Responsive Grid */
        @media (max-width: 1200px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .sidebar {
                width: 260px;
            }
            
            .main-content {
                margin-left: 260px;
                padding: var(--space-lg);
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                border-right: none;
                border-bottom: 1px solid var(--gray-200);
            }

            .main-content {
                margin-left: 0;
                padding: var(--space-md);
            }

            .content-grid {
                grid-template-columns: 1fr;
                gap: var(--space-md);
            }
            
            .page-header h2 {
                font-size: 1.875rem;
            }
            
            .card-body {
                padding: var(--space-lg);
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: var(--space-sm);
            }
            
            .page-header h2 {
                font-size: 1.5rem;
            }
            
            .card-body {
                padding: var(--space-md);
            }
        }

        /* Styling untuk list dan timeline */
        .timeline-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e9ecef;
        }

        .timeline-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .timeline-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #6c757d;
            margin-right: 1rem;
            margin-top: 0.5rem;
            flex-shrink: 0;
        }

        .timeline-content {
            flex-grow: 1;
        }

        .timeline-date {
            font-weight: 600;
            color: #6c757d;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .timeline-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .timeline-description {
            color: #6c757d;
            line-height: 1.6;
            margin: 0;
        }

        /* Styling untuk info sections */
        .info-section {
            margin-bottom: 1.5rem;
        }

        .info-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .info-text {
            color: #6c757d;
            margin: 0;
            line-height: 1.6;
        }

        /* Styling untuk news items */
        .news-item {
            padding: 1rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .news-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .news-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .news-date {
            font-size: 0.875rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .news-description {
            color: #6c757d;
            line-height: 1.6;
            margin: 0;
        }

        /* Styling untuk facility list */
        .facility-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .facility-list li {
            padding: 0.5rem 0;
            color: #6c757d;
            border-bottom: 1px solid #e9ecef;
        }

        .facility-list li:last-child {
            border-bottom: none;
        }

        /* Styling untuk contact info */
        .contact-info {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .contact-info li {
            padding: 0.5rem 0;
            color: #6c757d;
            border-bottom: 1px solid #e9ecef;
        }

        .contact-info li:last-child {
            border-bottom: none;
        }

        /* Styling untuk foto gedung sekolah */
        .school-building-photo {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .school-building-photo:hover {
            transform: scale(1.02);
        }

        .upload-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 2px dashed #6c757d;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .upload-section:hover {
            border-color: #495057;
            background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            padding: 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 8px;
            background-color: #ffffff;
        }

        .file-input-wrapper input[type=file]:focus {
            border-color: #6c757d;
            box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25);
        }

        .btn-upload {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #495057 100%);
            border: none;
            color: var(--white-color);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-upload:hover {
            background: linear-gradient(135deg, #495057 0%, #343a40 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-delete {
            background: linear-gradient(135deg, var(--danger-color) 0%, #c82333 100%);
            border: none;
            color: var(--white-color);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
        }

        /* Styling untuk tombol disabled */
        .btn-upload:disabled {
            background: linear-gradient(135deg, #adb5bd 0%, #6c757d 100%);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-upload:disabled:hover {
            background: linear-gradient(135deg, #adb5bd 0%, #6c757d 100%);
            transform: none;
            box-shadow: none;
        }

        .upload-section.disabled {
            opacity: 0.7;
            pointer-events: none;
        }
        /* Bootstrap-themed overrides */
        .sidebar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--info-color) 100%) !important;
            color: var(--white-color);
            box-shadow: var(--shadow);
        }

        .sidebar-header {
            background: transparent !important;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .sidebar h4 { color: var(--white-color) !important; }
        .sidebar a { color: rgba(255,255,255,0.85) !important; }
        .sidebar a:hover {
            background: rgba(255,255,255,0.12) !important;
            color: var(--white-color) !important;
            border-left-color: rgba(255,255,255,0.6) !important;
        }
        .sidebar a.active {
            background: rgba(255,255,255,0.18) !important;
            color: var(--white-color) !important;
            border-left-color: var(--white-color) !important;
        }

        .user-info { background: rgba(255,255,255,0.12) !important; border-color: rgba(255,255,255,0.25) !important; }
        .user-info small { color: var(--white-color) !important; }

        .logout-btn { border-color: var(--danger-color); color: var(--danger-color); }
        .logout-btn:hover { background: var(--danger-color); border-color: var(--danger-color); }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--info-color) 100%) !important;
            border: none;
        }

        .card-header h5 { color: var(--white-color) !important; }
        .page-header h2 { color: var(--dark-color); }
        .vision-quote { border-left-color: var(--secondary-color); color: var(--dark-color); }
        .info-link { color: rgba(0,0,0,0.55); }
        .info-link:hover { color: var(--dark-color); }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h4>SMKN 4</h4>
        </div>
        
        <div class="sidebar-nav">
            <!-- Menu untuk semua pengunjung -->
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">🏠 Beranda</a>
            <a href="/public/informasi#agenda?v={{ time() }}" class="{{ request()->is('public/informasi*') ? 'active' : '' }}">🗓️ Agenda</a>
            <a href="/public/informasi" class="{{ request()->is('public/informasi*') ? 'active' : '' }}">ℹ️ Informasi</a>
            <a href="/public/galeri" class="{{ request()->is('public/galeri*') ? 'active' : '' }}">🖼️ Galeri</a>
        </div>
        
        @auth('admin')
            <!-- Menu admin yang sudah login -->
            <div class="sidebar-nav">
                <a href="{{ route('admin.galeri') }}" class="{{ request()->routeIs('admin.galeri*') ? 'active' : '' }}">📸 Kelola Galeri</a>
            </div>
            
            <!-- User section untuk admin -->
            <div class="user-section">
                <div class="user-info">
                    <small>🔐 Admin Panel</small>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        🚪 Logout Admin
                    </button>
                </form>
            </div>
        @elseif(Auth::check())
            <!-- User biasa yang sudah login -->
            <div class="user-section">
                <div class="user-info">
                    <small>👤 {{ Auth::user()->name }}</small>
                </div>
                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        🚪 Logout User
                    </button>
                </form>
            </div>
        @else
            <!-- Belum login - tampilkan opsi login -->
            <div class="sidebar-nav">
                <a href="{{ route('login.choice') }}" class="{{ request()->routeIs('login.choice') ? 'active' : '' }}">🔐 Login</a>
            </div>
        @endauth
    </div>

    <div class="main-content">
        <div class="page-header">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Ensure smooth scrolling works for anchor links
        document.addEventListener('DOMContentLoaded', function() {
            // Handle anchor links
            const anchorLinks = document.querySelectorAll('a[href*="#"]');
            anchorLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href.includes('#')) {
                        const targetId = href.split('#')[1];
                        const targetElement = document.getElementById(targetId);
                        if (targetElement) {
                            e.preventDefault();
                            targetElement.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
