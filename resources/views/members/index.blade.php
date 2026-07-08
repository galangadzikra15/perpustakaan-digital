@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>
            <i class="bi bi-people-fill"></i> Data Anggota
        </h2>
        <a href="{{ url('/members/create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Anggota
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Angkatan</th>
                            <th>Jurusan</th>
                            <th>Fakultas</th>
                            <!-- HAPUS KOLOM NO TELEPON -->
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $index => $member)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $member->NIM }}</strong></td>
                            <td>{{ $member->nama }}</td>
                            <td>{{ $member->angkatan }}</td>
                            <td>{{ $member->jurusan }}</td>
                            <td>{{ $member->fakultas }}</td>
                            <!-- HAPUS NO TELEPON -->
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ url('/members/' . $member->NIM . '/edit') }}" 
                                       class="btn btn-sm btn-warning text-white">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ url('/members/' . $member->NIM) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="bi bi-inbox fs-1 d-block"></i>
                                <p class="text-muted mt-2">Belum ada data anggota</p>
                                <a href="{{ url('/members/create') }}" class="btn btn-primary btn-sm">
                                    Tambah Anggota Pertama
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection