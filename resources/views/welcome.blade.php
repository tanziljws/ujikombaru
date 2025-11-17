<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 4 Bogor - Galeri Sekolah Digital</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        header { background: #dc3545; color: white; padding: 40px 0; text-align: center; }
        nav { background: #333; padding: 10px 0; text-align: center; }
        nav a { color: white; text-decoration: none; padding: 10px 20px; display: inline-block; }
        nav a:hover { background: #555; }
        .hero { text-align: center; padding: 60px 20px; }
        .hero h1 { font-size: 2.5em; color: #dc3545; margin-bottom: 20px; }
        .cta-buttons { margin-top: 30px; }
        .cta-buttons a { display: inline-block; padding: 15px 30px; margin: 10px; background: #dc3545; color: white; text-decoration: none; border-radius: 5px; }
        .cta-buttons a:hover { background: #c82333; }
        footer { background: #333; color: white; text-align: center; padding: 20px 0; margin-top: 40px; }
    </style>
</head>
<body>
    <header>
        <h1>SMK NEGERI 4 BOGOR</h1>
        <p>Galeri Sekolah Digital</p>
    </header>
    
    <nav>
        <a href="/">Beranda</a>
        <a href="/public/informasi">Informasi</a>
        <a href="/public/galeri">Galeri</a>
        <a href="/public/agenda">Agenda</a>
        <a href="/login">Login</a>
    </nav>

    <div class="container">
        <div class="hero">
            <h1>Selamat Datang</h1>
            <p>Portal Informasi dan Galeri SMK Negeri 4 Bogor</p>
            <div class="cta-buttons">
                <a href="/public/informasi">Lihat Informasi</a>
                <a href="/public/galeri">Lihat Galeri</a>
                <a href="/public/agenda">Lihat Agenda</a>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} SMK Negeri 4 Bogor. All rights reserved.</p>
    </footer>
</body>
</html>

