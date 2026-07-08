<!DOCTYPE html>
<html>
<head>
    <title>Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar akan dimasukkan di sini -->
    @include('partials.navbar')

    <!-- Konten utama -->
    <main class="flex-grow-1" style="padding-top:70px;">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>