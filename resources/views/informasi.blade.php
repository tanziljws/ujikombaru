<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 4 Bogor - Informasi Sekolah</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        header { background: #dc3545; color: white; padding: 20px 0; text-align: center; }
        nav { background: #333; padding: 10px 0; }
        nav a { color: white; text-decoration: none; padding: 10px 20px; display: inline-block; }
        nav a:hover { background: #555; }
        .section { margin: 40px 0; }
        h1, h2 { color: #dc3545; margin-bottom: 20px; }
        .jurusan-list, .akreditasi-list { list-style: none; }
        .jurusan-list li, .akreditasi-list li { padding: 10px; margin: 5px 0; background: #f5f5f5; border-left: 4px solid #dc3545; }
        .news-item { padding: 15px; margin: 10px 0; background: #f9f9f9; border-radius: 5px; }
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
        <div class="section">
            <h2>Jurusan</h2>
            <ul class="jurusan-list">
                @forelse($jurusan as $item)
                    <li>{{ $item->value }}</li>
                @empty
                    <li>Belum ada data jurusan</li>
                @endforelse
            </ul>
        </div>

        <div class="section">
            <h2>Akreditasi</h2>
            <ul class="akreditasi-list">
                @forelse($akreditasi as $item)
                    <li>{{ $item->value }}</li>
                @empty
                    <li>Belum ada data akreditasi</li>
                @endforelse
            </ul>
        </div>

        <div class="section">
            <h2>Berita Terkini</h2>
            @forelse($news as $item)
                <div class="news-item">
                    <h3>{{ $item->judul }}</h3>
                    <p>{{ $item->deskripsi }}</p>
                    <small>Tanggal: {{ $item->tanggal->format('d M Y') }}</small>
                </div>
            @empty
                <p>Belum ada berita</p>
            @endforelse
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} SMK Negeri 4 Bogor. All rights reserved.</p>
    </footer>
</body>
</html>

