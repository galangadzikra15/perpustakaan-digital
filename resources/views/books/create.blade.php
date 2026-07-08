@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header bg-primary text-white">

        <h4 class="mb-0">
            Tambah Buku
        </h4>

    </div>

    <div class="card-body">

        <form action="{{ url('/books') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Judul Buku
                </label>

                <input
                    type="text"
                    name="judul"
                    class="form-control"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Penulis
                </label>

                <input
                    type="text"
                    name="penulis"
                    class="form-control"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Penerbit
                </label>

                <input
                    type="text"
                    name="penerbit"
                    class="form-control"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Tahun Terbit
                </label>

                <input
                    type="number"
                    name="tahun_terbit"
                    class="form-control"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Sinopsis
                </label>

                <textarea
                    name="sinopsis"
                    rows="5"
                    class="form-control"></textarea>

            </div>

            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

            <a href="{{ url('/books') }}" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection