<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/dashboard') }}">
            <i class="bi bi-book"></i> Perpustakaan Digital
        </a>
        <button 
            class="navbar-toggler" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto">
                <!-- Menu yang muncul jika sudah login -->
                @if(session('login'))
                    <!-- Dropdown User -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" 
                           href="#" 
                           id="navbarDropdown" 
                           role="button" 
                           data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> 
                            {{ session('nama') ?? 'User' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ url('/dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/books') }}">
                                    <i class="bi bi-book"></i> Data Buku
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/members') }}">
                                    <i class="bi bi-people"></i> Data Anggota
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/loans') }}">
                                    <i class="bi bi-journal"></i> Data Peminjaman
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <!-- TOMBOL LOGOUT -->
                                <form action="{{ url('/logout') }}" method="POST" id="logout-form">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <!-- Jika belum login -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>