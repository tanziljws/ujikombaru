<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Statistik Galeri</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #0066CC;
        }
        
        .header h1 {
            color: #0066CC;
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .header h2 {
            color: #666;
            font-size: 18px;
            font-weight: normal;
            margin-bottom: 10px;
        }
        
        .header .period {
            font-size: 11px;
            color: #888;
            margin-top: 10px;
        }
        
        .summary {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }
        
        .summary-item {
            display: table-cell;
            width: 25%;
            padding: 15px;
            text-align: center;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
        }
        
        .summary-item .label {
            font-size: 10px;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        
        .summary-item .value {
            font-size: 20px;
            font-weight: bold;
            color: #0066CC;
        }
        
        .summary-item .subvalue {
            font-size: 9px;
            color: #888;
            margin-top: 3px;
        }
        
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #0066CC;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #0066CC;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        table thead {
            background: #0066CC;
            color: white;
        }
        
        table th {
            padding: 8px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
        }
        
        table td {
            padding: 8px;
            border-bottom: 1px solid #dee2e6;
            font-size: 11px;
        }
        
        table tbody tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        
        .top-list {
            margin-bottom: 20px;
        }
        
        .top-list-item {
            padding: 8px;
            margin-bottom: 5px;
            background: #f8f9fa;
            border-left: 3px solid #0066CC;
        }
        
        .top-list-item .rank {
            display: inline-block;
            width: 25px;
            height: 25px;
            background: #0066CC;
            color: white;
            text-align: center;
            line-height: 25px;
            border-radius: 50%;
            margin-right: 10px;
            font-weight: bold;
        }
        
        .top-list-item .title {
            font-weight: bold;
            color: #333;
        }
        
        .top-list-item .category {
            font-size: 9px;
            color: #888;
            margin-left: 5px;
        }
        
        .top-list-item .count {
            float: right;
            background: #28a745;
            color: white;
            padding: 2px 8px;
            border-radius: 3px;
            font-weight: bold;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            text-align: center;
            font-size: 10px;
            color: #888;
        }
        
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>SMKN 4 BOGOR</h1>
        <h2>Laporan Statistik Galeri</h2>
        <div class="period">
            Periode: {{ \Carbon\Carbon::parse($dateFrom)->format('d F Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('d F Y') }}
            <br>
            Dicetak pada: {{ now()->format('d F Y H:i') }}
        </div>
    </div>

    <!-- Summary Statistics -->
    <div class="summary">
        <div class="summary-item">
            <div class="label">Total Galeri</div>
            <div class="value">{{ number_format($statistics['totalGaleri']) }}</div>
        </div>
        <div class="summary-item">
            <div class="label">Total Views</div>
            <div class="value">{{ number_format($statistics['totalViews']) }}</div>
            <div class="subvalue">Rata-rata: {{ number_format($statistics['avgViews'], 1) }}/foto</div>
        </div>
        <div class="summary-item">
            <div class="label">Total Likes</div>
            <div class="value">{{ number_format($statistics['totalLikes']) }}</div>
            <div class="subvalue">Rata-rata: {{ number_format($statistics['avgLikes'], 1) }}/foto</div>
        </div>
        <div class="summary-item">
            <div class="label">Total Komentar</div>
            <div class="value">{{ number_format($statistics['totalComments']) }}</div>
            <div class="subvalue">Rata-rata: {{ number_format($statistics['avgComments'], 1) }}/foto</div>
        </div>
    </div>

    <!-- Distribusi per Kategori -->
    <div class="section">
        <div class="section-title">Distribusi Galeri per Kategori</div>
        <table>
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th class="text-center">Jumlah Foto</th>
                    <th class="text-center">Persentase</th>
                </tr>
            </thead>
            <tbody>
                @forelse($statistics['galeriPerKategori'] as $item)
                <tr>
                    <td>{{ $item->kategori->nama ?? 'Tanpa Kategori' }}</td>
                    <td class="text-center">{{ $item->total }}</td>
                    <td class="text-center">
                        {{ $statistics['totalGaleri'] > 0 ? number_format(($item->total / $statistics['totalGaleri']) * 100, 1) : 0 }}%
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Page Break -->
    <div class="page-break"></div>

    <!-- Top 10 Paling Dilihat -->
    <div class="section">
        <div class="section-title">Top 10 Galeri Paling Dilihat</div>
        <div class="top-list">
            @forelse($statistics['topViewed'] as $index => $galeri)
            <div class="top-list-item">
                <span class="rank">{{ $index + 1 }}</span>
                <span class="title">{{ $galeri->judul }}</span>
                <span class="category">({{ $galeri->kategori->nama ?? 'Tanpa Kategori' }})</span>
                <span class="count">{{ number_format($galeri->views) }} views</span>
            </div>
            @empty
            <p class="text-center">Tidak ada data</p>
            @endforelse
        </div>
    </div>

    <!-- Top 10 Paling Disukai -->
    <div class="section">
        <div class="section-title">Top 10 Galeri Paling Disukai</div>
        <div class="top-list">
            @forelse($statistics['topLiked'] as $index => $galeri)
            <div class="top-list-item">
                <span class="rank">{{ $index + 1 }}</span>
                <span class="title">{{ $galeri->judul }}</span>
                <span class="category">({{ $galeri->kategori->nama ?? 'Tanpa Kategori' }})</span>
                <span class="count">{{ number_format($galeri->likes) }} likes</span>
            </div>
            @empty
            <p class="text-center">Tidak ada data</p>
            @endforelse
        </div>
    </div>

    <!-- Top 10 Paling Banyak Komentar -->
    <div class="section">
        <div class="section-title">Top 10 Galeri Paling Banyak Komentar</div>
        <div class="top-list">
            @forelse($statistics['topCommented'] as $index => $galeri)
            <div class="top-list-item">
                <span class="rank">{{ $index + 1 }}</span>
                <span class="title">{{ $galeri->judul }}</span>
                <span class="category">({{ $galeri->kategori->nama ?? 'Tanpa Kategori' }})</span>
                <span class="count">{{ number_format($galeri->galeri_comments_count) }} komentar</span>
            </div>
            @empty
            <p class="text-center">Tidak ada data</p>
            @endforelse
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh Sistem Manajemen Galeri SMKN 4 Bogor</p>
        <p>&copy; {{ date('Y') }} SMKN 4 Bogor. All Rights Reserved.</p>
    </div>
</body>
</html>
