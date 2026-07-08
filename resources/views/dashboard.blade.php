@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col">
            <h2>
                <i class="bi bi-speedometer2"></i> Dashboard
            </h2>
            <p class="text-muted">
                Selamat datang, <strong>{{ session('nama') ?? 'Administrator' }}</strong>
            </p>
            <hr>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <!-- Total Buku -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-uppercase fw-bold">Total Buku</h6>
                            <h2 class="mb-0">{{ $totalBooks ?? 0 }}</h2>
                        </div>
                        <div class="fs-1">
                            <i class="bi bi-book"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <small class="text-white-50">
                            <i class="bi bi-arrow-right"></i> 
                            <a href="{{ url('/books') }}" class="text-white text-decoration-none">
                                Lihat semua buku
                            </a>
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Anggota -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-uppercase fw-bold">Total Anggota</h6>
                            <h2 class="mb-0">{{ $totalMembers ?? 0 }}</h2>
                        </div>
                        <div class="fs-1">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <small class="text-white-50">
                            <i class="bi bi-arrow-right"></i> 
                            <a href="{{ url('/members') }}" class="text-white text-decoration-none">
                                Lihat semua anggota
                            </a>
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peminjaman Aktif -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-uppercase fw-bold">Dipinjam</h6>
                            <h2 class="mb-0">{{ $activeLoans ?? 0 }}</h2>
                        </div>
                        <div class="fs-1">
                            <i class="bi bi-journal"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <small class="text-white-50">
                            <i class="bi bi-arrow-right"></i> 
                            <a href="{{ url('/loans') }}" class="text-white text-decoration-none">
                                Lihat peminjaman
                            </a>
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Terlambat -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-danger h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-uppercase fw-bold">Terlambat</h6>
                            <h2 class="mb-0">{{ $lateReturns ?? 0 }}</h2>
                        </div>
                        <div class="fs-1">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <small class="text-white-50">
                            <i class="bi bi-arrow-right"></i> 
                            <a href="{{ url('/loans') }}" class="text-white text-decoration-none">
                                Lihat yang terlambat
                            </a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Navigasi Cepat -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="bi bi-grid-3x3-gap-fill"></i> Menu Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Buku -->
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-primary">
                                <div class="card-body text-center">
                                    <i class="bi bi-book display-4 text-primary"></i>
                                    <h5 class="card-title mt-3">Data Buku</h5>
                                    <p class="card-text text-muted small">
                                        Kelola koleksi buku perpustakaan
                                    </p>
                                    <a href="{{ url('/books') }}" class="btn btn-primary">
                                        <i class="bi bi-arrow-right"></i> Kelola
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Anggota -->
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-success">
                                <div class="card-body text-center">
                                    <i class="bi bi-people display-4 text-success"></i>
                                    <h5 class="card-title mt-3">Data Anggota</h5>
                                    <p class="card-text text-muted small">
                                        Kelola data anggota perpustakaan
                                    </p>
                                    <a href="{{ url('/members') }}" class="btn btn-success">
                                        <i class="bi bi-arrow-right"></i> Kelola
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Peminjaman -->
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-warning">
                                <div class="card-body text-center">
                                    <i class="bi bi-journal display-4 text-warning"></i>
                                    <h5 class="card-title mt-3">Data Peminjaman</h5>
                                    <p class="card-text text-muted small">
                                        Kelola transaksi peminjaman buku
                                    </p>
                                    <a href="{{ url('/loans') }}" class="btn btn-warning">
                                        <i class="bi bi-arrow-right"></i> Kelola
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="bi bi-clock-history"></i> Aktivitas Peminjaman Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    @if(isset($recentLoans) && $recentLoans->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Buku</th>
                                        <th>Anggota</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
    @if(isset($recentLoans) && $recentLoans->count() > 0)
        @foreach($recentLoans as $index => $loan)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>
                <strong>{{ $loan->book->judul ?? 'Data dihapus' }}</strong>
                <br>
                <small class="text-muted">{{ $loan->book->penulis ?? '' }}</small>
            </td>
            <td>
                {{ $loan->member->nama ?? 'Data dihapus' }}
                <br>
                <small class="text-muted">{{ $loan->member->NIM ?? '' }}</small>
            </td>
            <td>
                {{ date('d-m-Y', strtotime($loan->tanggal_pinjam)) }}
                @if($loan->tanggal_kembali)
                    <br>
                    <small class="text-success">
                        <i class="bi bi-arrow-return-left"></i> 
                        {{ date('d-m-Y', strtotime($loan->tanggal_kembali)) }}
                    </small>
                @endif
            </td>
            <td>
                @php
                    $statusColors = [
                        'dipinjam' => 'warning',
                        'dikembalikan' => 'success',
                        'hilang' => 'danger',
                        'terlambat' => 'dark'
                    ];
                    $statusIcons = [
                        'dipinjam' => 'clock',
                        'dikembalikan' => 'check-circle',
                        'hilang' => 'x-circle',
                        'terlambat' => 'exclamation-triangle'
                    ];
                    $color = $statusColors[$loan->status] ?? 'secondary';
                    $icon = $statusIcons[$loan->status] ?? 'circle';
                @endphp
                <span class="badge bg-{{ $color }}">
                    <i class="bi bi-{{ $icon }}"></i>
                    {{ ucfirst($loan->status ?? '-') }}
                </span>
            </td>
            <td class="text-center">
                <!-- Tombol Detail -->
                <a href="{{ url('/loans/'.$loan->id_peminjaman) }}" 
                   class="btn btn-sm btn-info text-white me-1" 
                   title="Lihat Detail">
                    Detail
                </a>
                
                <!-- Tombol Edit -->
                <a href="{{ url('/loans/'.$loan->id_peminjaman.'/edit') }}" 
                   class="btn btn-sm btn-warning text-white me-1" 
                   title="Edit">
                    Edit
                </a>
                
                <!-- Tombol Hapus -->
                <form action="{{ url('/loans/'.$loan->id_peminjaman) }}" 
                      method="POST" 
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn btn-sm btn-danger me-1" 
                            onclick="return confirm('Yakin ingin menghapus data peminjaman ini?')"
                            title="Hapus">
                        Hapus
                    </button>
                </form>
                
                <!-- Tombol Kembalikan (khusus status dipinjam) -->
                @if($loan->status == 'dipinjam')
                    <a href="{{ url('/loans/return/'.$loan->id_peminjaman) }}" 
                       class="btn btn-sm btn-success" 
                       onclick="return confirm('Kembalikan buku ini?')"
                       title="Kembalikan Buku">
                        Kembalikan
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
    @else
        <tr>
            <td colspan="6" class="text-center text-muted py-4">
                <i class="bi bi-inbox display-4 d-block mb-2"></i>
                <p class="mb-0">Belum ada aktivitas peminjaman</p>
                <a href="{{ url('/loans/create') }}" class="btn btn-primary btn-sm mt-2">
                    <i class="bi bi-plus-circle"></i> Tambah Peminjaman
                </a>
            </td>
        </tr>
    @endif
</tbody>
                            </table>
                        </div>
                        <div class="text-end mt-2">
                            <a href="{{ url('/loans') }}" class="btn btn-outline-primary btn-sm">
                                Lihat Semua <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-inbox display-4 text-muted"></i>
                            <p class="text-muted mt-2">Belum ada aktivitas peminjaman</p>
                            <a href="{{ url('/loans/create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-circle"></i> Tambah Peminjaman
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection