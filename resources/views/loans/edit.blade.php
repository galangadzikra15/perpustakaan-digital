@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3><i class="bi bi-pencil"></i> Edit Peminjaman</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('/loans/'.$loan->id_peminjaman) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="id_buku" class="form-label">Pilih Buku <span class="text-danger">*</span></label>
                            <select name="id_buku" id="id_buku" class="form-control @error('id_buku') is-invalid @enderror" required>
                                <option value="">-- Pilih Buku --</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id_buku }}" {{ old('id_buku', $loan->id_buku) == $book->id_buku ? 'selected' : '' }}>
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
                                    <option value="{{ $member->NIM }}" {{ old('NIM', $loan->NIM) == $member->NIM ? 'selected' : '' }}>
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
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="dipinjam" {{ old('status', $loan->status) == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="dikembalikan" {{ old('status', $loan->status) == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                <option value="terlambat" {{ old('status', $loan->status) == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                                <option value="hilang" {{ old('status', $loan->status) == 'hilang' ? 'selected' : '' }}>Hilang</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea name="catatan" 
                                      id="catatan" 
                                      class="form-control @error('catatan') is-invalid @enderror" 
                                      rows="3">{{ old('catatan', $loan->catatan) }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
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