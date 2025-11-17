<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - SMKN 4 Bogor</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        header { background: #dc3545; color: white; padding: 20px 0; text-align: center; }
        nav { background: #333; padding: 10px 0; }
        nav a { color: white; text-decoration: none; padding: 10px 20px; display: inline-block; }
        nav a:hover { background: #555; }
        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin: 20px 0; }
        .gallery-item { background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .gallery-item img { width: 100%; height: 250px; object-fit: cover; }
        .gallery-item-content { padding: 15px; }
        .gallery-item h3 { color: #dc3545; margin-bottom: 10px; }
        footer { background: #333; color: white; text-align: center; padding: 20px 0; margin-top: 40px; }
    </style>
</head>
<body>
    <header>
        <h1>Galeri SMK Negeri 4 Bogor</h1>
    </header>
    
    <nav>
        <a href="/">Beranda</a>
        <a href="/public/informasi">Informasi</a>
        <a href="/public/galeri">Galeri</a>
        <a href="/public/agenda">Agenda</a>
        <a href="/login">Login</a>
    </nav>

    <div class="container">
        <h2>Galeri Foto</h2>
        <div class="gallery-grid">
            @forelse($galeri as $item)
                <div class="gallery-item">
                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}">
                    <div class="gallery-item-content">
                        <h3>{{ $item->judul }}</h3>
                        <p>{{ $item->deskripsi }}</p>
                        @if($item->kategori)
                            <small>Kategori: {{ $item->kategori->nama }}</small>
                        @endif
                    </div>
                </div>
            @empty
                <p>Belum ada foto di galeri</p>
            @endforelse
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} SMK Negeri 4 Bogor. All rights reserved.</p>
    </footer>
</body>
</html>

