@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>📚 Data Buku</h2>
    <div>
        <button 
            class="btn btn-primary btn-sm me-2" 
            data-bs-toggle="modal" 
            data-bs-target="#importModal"
        >
            📥 Import Excel
        </button>
        <a href="/dashboard" class="btn btn-secondary btn-sm me-2">Dashboard</a>
        <a href="{{ url('/books/create') }}" class="btn btn-success btn-sm">+ Tambah Buku</a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th width="80">ID</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th width="120">Tahun</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td>{{ $book->id_buku }}</td>
                    <td>{{ $book->judul }}</td>
                    <td>{{ $book->penulis }}</td>
                    <td>{{ $book->penerbit }}</td>
                    <td>{{ $book->tahun_terbit }}</td>
                    <td>
                        <a href="{{ url('/books/'.$book->id_buku.'/edit') }}" class="btn btn-warning btn-sm">
                            ✏️ Edit
                        </a>
                        <form action="{{ url('/books/'.$book->id_buku) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                🗑️ Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        📭 Belum ada data buku
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Import Excel -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="importModalLabel">📤 Import Data Buku</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <strong>📌 Panduan:</strong>
                    <ul class="mb-0">
                        <li>File harus berformat <strong>.xlsx</strong> atau <strong>.xls</strong></li>
                        <li>Kolom yang dibutuhkan: <strong>judul, penulis, penerbit, tahun_terbit, sinopsis</strong></li>
                        <li>Baris pertama harus berupa header/nama kolom</li>
                    </ul>
                </div>
                
                <form action="{{ route('books.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label fw-bold">Pilih File Excel</label>
                        <input type="file" name="file" id="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                        <small class="text-muted">Max size: 2MB</small>
                    </div>
                    <button type="submit" class="btn btn-success w-100">
                        📤 Upload & Import
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection