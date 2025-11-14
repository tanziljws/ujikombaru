<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 4 Bogor - Login Admin</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #0066CC;   /* unified blue */
            --secondary-color: #4B5563; /* gray */
            --success-color: #16A34A;
            --info-color: #4B3F72;      /* accent purple */
            --warning-color: #FACC15;
            --danger-color: #e74c3c;
            --light-color: #F9FAFB;
            --dark-color: #1F2937;
            --white-color: #ffffff;
            --body-bg: #F9FAFB;
            --card-bg: #ffffff;
            --border-color: #e5e7eb;
            --text-muted: #4B5563;
            --shadow-sm: 0 .125rem .25rem rgba(0,0,0,.075);
            --shadow: 0 .5rem 1rem rgba(0,0,0,.15);
            --shadow-lg: 0 1rem 3rem rgba(0,0,0,.175);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: var(--primary-color);
            min-height: 100vh;
            position: relative;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            z-index: -1;
        }
        
        .main-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        
        .login-card {
            background: var(--card-bg);
            border-radius: 1rem;
            box-shadow: var(--shadow-lg);
            padding: 2rem;
            width: 100%;
            max-width: 380px;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }
        
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-color);
        }
        
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .header-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        
        .school-logo {
            width: 140px;
            height: 140px;
            background: #ffffff;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            padding: 10px;
            border: 2px solid #e0e0e0;
        }
        
        
        .school-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 1rem;
        }
        
        .school-logo i {
            font-size: 2rem;
            color: var(--white-color);
        }
        
        .main-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .subtitle {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 400;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 0.5rem;
            padding: 0.6rem 0.8rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: var(--card-bg);
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            background: var(--card-bg);
        }
        
        .input-group {
            position: relative;
        }
        
        .input-group-text {
            background: var(--light-color);
            border: 2px solid var(--border-color);
            border-right: none;
            border-radius: 0.5rem 0 0 0.5rem;
            color: var(--text-muted);
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 0.5rem 0.5rem 0;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: var(--primary-color);
            background: var(--light-color);
        }
        
        .btn-login {
            background: var(--primary-color);
            border: none;
            border-radius: 0.5rem;
            padding: 0.7rem 1.2rem;
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--white-color);
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            color: var(--white-color);
            background: #0057ad;
        }
        
        .form-check {
            margin: 1.5rem 0;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .credentials-box {
            background: var(--light-color);
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-top: 2rem;
            text-align: center;
        }
        
        .credentials-title {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 1rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .credential-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
            padding: 0.75rem;
            background: var(--card-bg);
            border-radius: 0.5rem;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }
        
        .credential-item:hover {
            box-shadow: var(--shadow-sm);
        }
        
        .credential-label {
            font-weight: 500;
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        
        .credential-value {
            font-weight: 600;
            color: var(--danger-color);
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            background: var(--light-color);
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
        }
        
        .footer-section {
            text-align: center;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }
        
        .back-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .back-link:hover {
            color: #135e96;
        }
        
        .alert {
            border-radius: 0.5rem;
            border: none;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #d1e7dd, #badbcc);
            color: #0f5132;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c2c7);
            color: #842029;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-card {
            animation: fadeInUp 0.8s ease-out;
        }
        
        /* Responsive Design */
        @media (max-width: 576px) {
            .main-container {
                padding: 1rem;
            }
            
            .login-card {
                padding: 2rem;
            }
            
            .main-title {
                font-size: 1.8rem;
            }
            
            .school-logo {
                width: 120px;
                height: 120px;
                padding: 8px;
            }
            
            .school-logo i {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="login-card">
            <div class="header-section">
                <div class="school-logo">
                    <img src="{{ asset('images/logo_smk_new.png') }}?v={{ time() }}" alt="Logo SMKN 4" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <i class="bi bi-shield-lock-fill" style="display: none;"></i>
                </div>
                <h1 class="main-title">SMKN 4 BOGOR</h1>
                <p class="subtitle">Panel Admin - Sistem Manajemen Sekolah</p>
            </div>
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                
                <div class="form-group">
                    <label for="username" class="form-label">
                        <i class="bi bi-person"></i>Username
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" 
                               id="username" name="username" value="{{ old('username') }}" 
                               placeholder="Masukkan username" required>
                    </div>
                    @error('username')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="bi bi-lock"></i>Password
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" placeholder="Masukkan password" required>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">
                        <i class="bi bi-clock me-2"></i>Ingat saya
                    </label>
                </div>
                
                <button type="submit" class="btn btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </button>
            </form>
            
            
            
            <div class="footer-section">
                <a href="/" class="back-link">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Homepage
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 