@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header bg-warning">

        <h4 class="mb-0">
            Edit Buku
        </h4>

    </div>

    <div class="card-body">

        <form
            action="{{ url('/books/'.$book->id_buku) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">
                    Judul Buku
                </label>

                <input
                    type="text"
                    name="judul"
                    value="{{ $book->judul }}"
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
                    value="{{ $book->penulis }}"
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
                    value="{{ $book->penerbit }}"
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
                    value="{{ $book->tahun_terbit }}"
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
                    class="form-control">{{ $book->sinopsis }}</textarea>

            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ url('/books') }}" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection