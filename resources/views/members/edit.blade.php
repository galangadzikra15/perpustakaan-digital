@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3><i class="bi bi-pencil-square"></i> Edit Anggota</h3>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                </div>
            @endif

            <form action="{{ url('/members/' . $member->NIM) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="NIM" class="form-label">NIM <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="NIM" 
                                   id="NIM" 
                                   class="form-control @error('NIM') is-invalid @enderror" 
                                   value="{{ old('NIM', $member->NIM) }}"
                                   readonly
                                   style="background-color: #e9ecef;">
                            <small class="text-muted">NIM tidak dapat diubah</small>
                            @error('NIM')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="nama" 
                                   id="nama" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   value="{{ old('nama', $member->nama) }}"
                                   required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="angkatan" class="form-label">Angkatan <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="angkatan" 
                                   id="angkatan" 
                                   class="form-control @error('angkatan') is-invalid @enderror" 
                                   value="{{ old('angkatan', $member->angkatan) }}"
                                   required>
                            @error('angkatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="jurusan" 
                                   id="jurusan" 
                                   class="form-control @error('jurusan') is-invalid @enderror" 
                                   value="{{ old('jurusan', $member->jurusan) }}"
                                   required>
                            @error('jurusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="fakultas" class="form-label">Fakultas <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="fakultas" 
                                   id="fakultas" 
                                   class="form-control @error('fakultas') is-invalid @enderror" 
                                   value="{{ old('fakultas', $member->fakultas) }}"
                                   required>
                            @error('fakultas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ url('/members') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection