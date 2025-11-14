<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SMKN 4 Bogor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --accent-color: #7c3aed;
        }
        body {
            background: #0066cc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Inter', sans-serif;
            position: relative;
            overflow-x: hidden;
            overflow-y: auto;
            padding: 2rem 0;
        }
        
        /* Animated Background Pattern */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            animation: backgroundMove 20s ease-in-out infinite;
        }
        
        @keyframes backgroundMove {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(50px, 50px); }
        }
        
        /* Floating Shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 15s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }
        
        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
        }
        
        .register-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.3);
            overflow: hidden;
            position: relative;
            z-index: 10;
            backdrop-filter: blur(10px);
            animation: slideUp 0.6s ease-out;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .register-header {
            background: #0066cc;
            color: white;
            padding: 1.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .register-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: headerGlow 8s ease-in-out infinite;
        }
        
        @keyframes headerGlow {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-20%, -20%); }
        }
        
        .register-header h3 {
            position: relative;
            z-index: 1;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
        }
        
        .register-header p {
            position: relative;
            z-index: 1;
        }
        
        .btn-primary {
            background: #0066cc;
            border: none;
            padding: 14px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 102, 204, 0.4);
        }
        
        .btn-primary:hover {
            background: #0052a3;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 102, 204, 0.6);
        }
        
        .form-control {
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            padding: 8px 12px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .form-label {
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
        }
        
        small.text-muted {
            font-size: 0.75rem;
        }
        
        .form-control:focus {
            border-color: #0066cc;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }
    </style>
</head>
<body>
    <!-- Floating Shapes -->
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="register-card">
                    <div class="register-header">
                        <h3><i class="fas fa-user-plus me-2"></i>Daftar Akun Baru</h3>
                        <p class="mb-0">SMKN 4 Bogor Gallery</p>
                    </div>
                    <div class="p-3">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('user.register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-2">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">NISN</label>
                                <input type="text" name="nisn" class="form-control" value="{{ old('nisn') }}" maxlength="10" placeholder="Nomor Induk Siswa Nasional" required>
                                <small class="text-muted">Masukkan 10 digit NISN Anda</small>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Foto Profil</label>
                                <input type="file" name="photo" class="form-control" accept="image/*" required>
                                <small class="text-muted">Upload foto profil Anda (JPG, PNG, max 2MB)</small>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Captcha: {{ ($captchaA ?? session('register_captcha_a')) }} + {{ ($captchaB ?? session('register_captcha_b')) }} = ?</label>
                                <input type="text" name="captcha" class="form-control" value="{{ old('captcha') }}" required>
                                <small class="text-muted">Please enter the result to verify you are human.</small>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-user-plus me-2"></i>Daftar
                            </button>
                        </form>
                        <div class="text-center">
                            <p class="mb-2">Sudah punya akun? <a href="{{ route('user.login.form') }}">Login di sini</a></p>
                            <a href="/" class="text-muted"><i class="fas fa-home me-1"></i>Kembali ke Beranda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
