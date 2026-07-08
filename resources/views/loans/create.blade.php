@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3><i class="bi bi-plus-circle"></i> Tambah Peminjaman Baru</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('/loans') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="id_buku" class="form-label">Pilih Buku <span class="text-danger">*</span></label>
                            <select name="id_buku" id="id_buku" class="form-control @error('id_buku') is-invalid @enderror" required>
                                <option value="">-- Pilih Buku --</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id_buku }}" {{ old('id_buku') == $book->id_buku ? 'selected' : '' }}>
                                        {{ $book->judul }} - {{ $book->penulis }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_buku')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="NIM" class="form-label">Pilih Anggota <span class="text-danger">*</span></label>
                            <select name="NIM" id="NIM" class="form-control @error('NIM') is-invalid @enderror" required>
                                <option value="">-- Pilih Anggota --</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->NIM }}" {{ old('NIM') == $member->NIM ? 'selected' : '' }}>
                                        {{ $member->nama }} ({{ $member->NIM }})
                                    </option>
                                @endforeach
                            </select>
                            @error('NIM')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                            <input type="date" 
                                   name="tanggal_pinjam" 
                                   id="tanggal_pinjam" 
                                   class="form-control @error('tanggal_pinjam') is-invalid @enderror" 
                                   value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                                   required>
                            @error('tanggal_pinjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea name="catatan" 
                                      id="catatan" 
                                      class="form-control @error('catatan') is-invalid @enderror" 
                                      rows="3">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ url('/loans') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection