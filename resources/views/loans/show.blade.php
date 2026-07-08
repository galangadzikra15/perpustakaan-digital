@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3><i class="bi bi-eye"></i> Detail Peminjaman</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="35%">ID Peminjaman</th>
                            <td><strong>#{{ $loan->id_peminjaman }}</strong></td>
                        </tr>
                        <tr>
                            <th>Buku</th>
                            <td>
                                <strong>{{ $loan->book->judul ?? 'Data dihapus' }}</strong>
                                <br>
                                <small class="text-muted">Penulis: {{ $loan->book->penulis ?? '-' }}</small>
                                <br>
                                <small class="text-muted">Penerbit: {{ $loan->book->penerbit ?? '-' }}</small>
                            </td>
                        </tr>
                        <tr>
                            <th>Anggota</th>
                            <td>
                                <strong>{{ $loan->member->nama ?? 'Data dihapus' }}</strong>
                                <br>
                                <small class="text-muted">NIM: {{ $loan->member->NIM ?? '-' }}</small>
                                <br>
                                <small class="text-muted">Jurusan: {{ $loan->member->jurusan ?? '-' }}</small>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="35%">Tanggal Pinjam</th>
                            <td>{{ date('d-m-Y', strtotime($loan->tanggal_pinjam)) }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Kembali</th>
                            <td>
                                @if($loan->tanggal_kembali)
                                    {{ date('d-m-Y', strtotime($loan->tanggal_kembali)) }}
                                @else
                                    <span class="text-muted">Belum dikembalikan</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($loan->status == 'dipinjam')
                                    <span class="badge bg-warning text-dark fs-6">
                                        <i class="bi bi-clock"></i> Dipinjam
                                    </span>
                                @elseif($loan->status == 'dikembalikan')
                                    <span class="badge bg-success fs-6">
                                        <i class="bi bi-check-circle"></i> Dikembalikan
                                    </span>
                                @elseif($loan->status == 'terlambat')
                                    <span class="badge bg-danger fs-6">
                                        <i class="bi bi-exclamation-circle"></i> Terlambat
                                    </span>
                                @elseif($loan->status == 'hilang')
                                    <span class="badge bg-secondary fs-6">
                                        <i class="bi bi-x-circle"></i> Hilang
                                    </span>
                                @else
                                    <span class="badge bg-secondary fs-6">{{ $loan->status }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Petugas</th>
                            <td>{{ $loan->user->nama ?? 'Data dihapus' }}</td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td>{{ $loan->catatan ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                @if($loan->status == 'dipinjam' || $loan->status == 'terlambat')
                    <a href="{{ url('/loans/return/'.$loan->id_peminjaman) }}" 
                       class="btn btn-success"
                       onclick="return confirm('Kembalikan buku ini?')">
                        <i class="bi bi-arrow-return-left"></i> Kembalikan Buku
                    </a>
                @endif
                <a href="{{ url('/loans') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Info tambahan -->
    <div class="card mt-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <small class="text-muted">
                        <i class="bi bi-info-circle"></i> Dibuat: 
                        {{ $loan->created_at ? $loan->created_at->format('d-m-Y H:i') : '-' }}
                    </small>
                </div>
                <div class="col-md-6 text-end">
                    <small class="text-muted">
                        <i class="bi bi-clock"></i> Terakhir diupdate: 
                        {{ $loan->updated_at ? $loan->updated_at->format('d-m-Y H:i') : '-' }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection