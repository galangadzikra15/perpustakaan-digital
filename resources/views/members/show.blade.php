@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3><i class="bi bi-person-badge"></i> Detail Anggota</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">NIM</th>
                            <td><strong>{{ $member->NIM }}</strong></td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $member->nama }}</td>
                        </tr>
                        <tr>
                            <th>Angkatan</th>
                            <td>{{ $member->angkatan }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>{{ $member->jurusan }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Fakultas</th>
                            <td>{{ $member->fakultas }}</td>
                        </tr>
                        <tr>
                            <th>No Telepon</th>
                            <td>{{ $member->no_telepon ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $member->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $member->alamat ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ url('/members/'.$member->NIM.'/edit') }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ url('/members') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Riwayat Peminjaman -->
    <div class="card mt-3">
        <div class="card-header">
            <h5><i class="bi bi-journal"></i> Riwayat Peminjaman</h5>
        </div>
        <div class="card-body">
            @if($member->loans->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($member->loans as $index => $loan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $loan->book->judul ?? 'Buku dihapus' }}</td>
                                <td>{{ date('d-m-Y', strtotime($loan->tanggal_pinjam)) }}</td>
                                <td>{{ $loan->tanggal_kembali ? date('d-m-Y', strtotime($loan->tanggal_kembali)) : '-' }}</td>
                                <td>
                                    @if($loan->status == 'dipinjam')
                                        <span class="badge bg-warning">Dipinjam</span>
                                    @elseif($loan->status == 'dikembalikan')
                                        <span class="badge bg-success">Dikembalikan</span>
                                    @elseif($loan->status == 'terlambat')
                                        <span class="badge bg-danger">Terlambat</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $loan->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted text-center">Belum ada riwayat peminjaman</p>
            @endif
        </div>
    </div>
</div>
@endsection