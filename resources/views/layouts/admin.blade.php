<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SMKN 4 - Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
        }

        /* Sidebar - Primary Color */
        .sidebar {
            background: var(--primary-color);
            min-height: 100vh;
            max-height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            box-shadow: var(--shadow);
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            z-index: 1000;
            transition: var(--transition);
        }

        /* Custom Scrollbar untuk Sidebar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .school-name {
            color: white;
            font-size: 1.8rem;
            font-weight: 800;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .school-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            margin: 0.5rem 0 0 0;
            font-weight: 500;
        }

        .sidebar-nav {
            padding: 2rem 1rem;
        }

        .nav-section {
            margin-bottom: 2rem;
        }

        .nav-section-title {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1rem;
            padding: 0 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-section-title i {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: var(--transition);
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.12);
            transform: translateX(5px);
            text-decoration: none;
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.18);
            color: white;
            border-left: 3px solid var(--warning-color);
        }

        .nav-link i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
        width: calc(100% - 280px); box-sizing: border-box; }

        /* Admin Status Card */
        .admin-status-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(0,0,0,0.05);
            margin-bottom: 2rem;
            transition: var(--transition);
        }

        .admin-status-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .admin-avatar {
            width: 50px;
            height: 50px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .admin-details h5 {
            margin: 0;
            color: var(--text-primary);
            font-weight: 700;
        }

        .admin-details p {
            margin: 0;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .logout-btn {
            background: linear-gradient(135deg, #fc8181 0%, #f56565 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
            color: white;
            text-decoration: none;
        }

        /* Quick Actions */
        .quick-actions {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        .quick-actions h4 {
            color: var(--text-primary);
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .action-item {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            border-radius: var(--border-radius);
            padding: 1rem;
            text-align: center;
            transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.05);
            text-decoration: none;
            color: var(--text-primary);
        }

        .action-item:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
            background: white;
            color: var(--primary-color);
            text-decoration: none;
        }

        .action-icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }

        .action-title {
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content { margin-left: 0; padding: 1rem; }

            .action-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Toggle Button for Mobile */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 0.5rem;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .sidebar-toggle {
                display: block;
            }
        }
    </style>
</head>
<body>
    <!-- Mobile Toggle Button -->
    <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h1 class="school-name">SMKN 4</h1>
            <p class="school-subtitle">Admin Panel</p>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-item">
                    <a href="{{ route('admin.galeri') }}" class="nav-link">
                        <i class="fas fa-images"></i>
                        Kelola Galeri
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('admin.galeri.report') }}" class="nav-link">
                        <i class="fas fa-chart-bar"></i>
                        Laporan Statistik
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('admin.users') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        Data User
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="/public/informasi" class="nav-link">
                        <i class="fas fa-info-circle"></i>
                        Update Info
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('admin.kelola-admin') }}" class="nav-link">
                        <i class="fas fa-user-cog"></i>
                        Kelola Admin
                    </a>
                </div>
            </div>

            @if(session('admin_authenticated'))
            <div class="nav-section">
                <div class="nav-section-title">
                    <i class="fas fa-user-shield"></i>
                    ADMIN STATUS
                </div>
                
                <div class="admin-status-card">
                    <div class="admin-info">
                        <div class="admin-avatar">
                            {{ substr(session('admin_name', 'A'), 0, 1) }}
                        </div>
                        <div class="admin-details">
                            <h5>Admin: {{ session('admin_name') }}</h5>
                            <p>Terautentikasi</p>
                        </div>
                    </div>
                    
                    <form action="/admin/logout" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout Admin
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.querySelector('.sidebar-toggle');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Set active nav link based on current page
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
