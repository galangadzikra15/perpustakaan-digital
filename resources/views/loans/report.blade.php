<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman Buku</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
        }
        .header-info {
            text-align: center;
            margin-bottom: 20px;
            color: #7f8c8d;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 8px;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .summary {
            margin-top: 30px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .summary table {
            width: 50%;
            margin: 0 auto;
        }
        .summary th {
            background-color: #2c3e50;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #95a5a6;
            font-size: 11px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 3px;
            font-size: 11px;
        }
        .badge-dipinjam { background: #f39c12; color: #fff; }
        .badge-dikembalikan { background: #27ae60; color: #fff; }
        .badge-hilang { background: #e74c3c; color: #fff; }
        .badge-terlambat { background: #c0392b; color: #fff; }
    </style>
</head>
<body>

    <h2>📚 LAPORAN PEMINJAMAN BUKU</h2>
    <div class="header-info">
        <strong>Bulan:</strong> {{ $bulan }} | 
        <strong>Tanggal Cetak:</strong> {{ date('d F Y') }}
    </div>

    <!-- Tabel Data -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Anggota</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $index => $loan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $loan->book->judul ?? '-' }}</td>
                <td>{{ $loan->member->nama ?? '-' }}</td>
                <td>{{ $loan->tanggal_pinjam }}</td>
                <td>{{ $loan->tanggal_kembali ?? '-' }}</td>
                <td>
                    <span class="badge badge-{{ $loan->status }}">
                        {{ ucfirst($loan->status) }}
                    </span>
                </td>
                <td>{{ $loan->catatan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;">Tidak ada data peminjaman</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Summary / Ringkasan -->
    <div class="summary">
        <h4 style="text-align:center; color:#2c3e50;">📊 RINGKASAN LAPORAN</h4>
        <table>
            <tr>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>📖 Buku Dipinjam</td>
                <td style="text-align:center;">{{ $dipinjam }}</td>
            </tr>
            <tr>
                <td>✅ Buku Dikembalikan</td>
                <td style="text-align:center;">{{ $dikembalikan }}</td>
            </tr>
            <tr>
                <td>⚠️ Buku Hilang</td>
                <td style="text-align:center;">{{ $hilang }}</td>
            </tr>
            <tr>
                <td>⏰ Buku Terlambat</td>
                <td style="text-align:center;">{{ $terlambat }}</td>
            </tr>
            <tr style="font-weight:bold; background-color:#ecf0f1;">
                <td>📌 Total Peminjaman</td>
                <td style="text-align:center;">{{ $loans->count() }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Dicetak oleh: Perpustakaan Digital | {{ date('Y') }}</p>
    </div>

</body>
</html>