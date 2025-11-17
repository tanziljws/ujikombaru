<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda - SMKN 4 Bogor</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        header { background: #dc3545; color: white; padding: 20px 0; text-align: center; }
        nav { background: #333; padding: 10px 0; }
        nav a { color: white; text-decoration: none; padding: 10px 20px; display: inline-block; }
        nav a:hover { background: #555; }
        .agenda-item { padding: 15px; margin: 10px 0; background: #f9f9f9; border-left: 4px solid #dc3545; border-radius: 5px; }
        footer { background: #333; color: white; text-align: center; padding: 20px 0; margin-top: 40px; }
    </style>
</head>
<body>
    <header>
        <h1>Agenda SMK Negeri 4 Bogor</h1>
    </header>
    
    <nav>
        <a href="/">Beranda</a>
        <a href="/public/informasi">Informasi</a>
        <a href="/public/galeri">Galeri</a>
        <a href="/public/agenda">Agenda</a>
        <a href="/login">Login</a>
    </nav>

    <div class="container">
        <h2>Agenda Sekolah</h2>
        @forelse($agendas as $agenda)
            <div class="agenda-item">
                <h3>{{ $agenda->judul }}</h3>
                <p><strong>Tanggal:</strong> {{ $agenda->tanggal->format('d M Y') }}</p>
                @if($agenda->deskripsi)
                    <p>{{ $agenda->deskripsi }}</p>
                @endif
            </div>
        @empty
            <p>Belum ada agenda</p>
        @endforelse
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} SMK Negeri 4 Bogor. All rights reserved.</p>
    </footer>
</body>
</html>

