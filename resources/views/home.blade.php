@extends('layouts.app')

@section('content')
<section id="home" class="vh-100 d-flex align-items-center">
    <div class="container text-center">
        <h1 class="display-3">Perpustakaan Digital</h1>
        <p class="lead">Selamat datang di website perpustakaan digital.</p>
    </div>
</section>

<section id="tentang" class="vh-100 d-flex align-items-center bg-light">
    <div class="container">
        <h2>Tentang Kami</h2>
        <p>Website ini dibuat menggunakan Laravel 11 dan Bootstrap 5.</p>
    </div>
</section>

<section id="kontak" class="vh-100 d-flex align-items-center">
    <div class="container">
        <h2>Kontak</h2>
        <p>Email : admin@perpustakaan.com</p>
        <p>Telepon : 08123456789</p>
    </div>
</section>
@endsection