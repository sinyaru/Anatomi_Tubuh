<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background-color: #fff0f6;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            width: 100%;
        }

        .dashboard-container {
            background-color: #fff;
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: row;
            overflow: hidden;
        }

        .sidebar {
            background-color: #f8bbd0;
            width: 250px;
            display: flex;
            flex-direction: column;
            padding: 25px 20px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            color: #4a4a4a;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: 0.3s;
            text-decoration: none;
        }

        .menu-item:hover,
        .menu-item.active {
            background-color: #f48fb1;
            color: #fff;
        }

        .menu-item i {
            margin-right: 10px;
            font-size: 18px;
        }

        .navbar {
            background-color: #f8bbd0;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #4a4a4a;
        }

        .navbar h3 {
            margin: 0;
            font-weight: 600;
        }

        .navbar .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        .navbar .admin-info i {
            background-color: #ec407a;
            color: white;
            padding: 8px;
            border-radius: 50%;
        }

        .main-content {
            flex: 1;
            background-color: #fffafc;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow-y: auto;
        }

        .content-wrapper {
            padding: 25px 40px;
            flex: 1;
        }

        /* 🎀 WARNA PINK SESUAI GAMBAR */
        .btn-soft-pink {
            background-color: #ec407a;
            color: white;
            border: none;
        }

        .btn-soft-pink:hover {
            background-color: #d81b60;
            color: white;
        }

        .profile-box {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
            gap: 8px;
        }

        .profile-box .dropdown-menu {
            display: none;
            position: absolute;
            top: 40px;
            right: 0;
            background: white;
            padding: 10px 15px;
            border-radius: 8px;
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .profile-box.open .dropdown-menu {
            display: block;
        }

        .profile-box .dropdown-menu a {
            text-decoration: none;
            color: #333;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            {{-- Dashboard Link --}}
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="bi bi-house"></i> Dashboard
            </a>
            @endif

            @if(auth()->user()->role === 'kontributor')
            <a href="{{ route('kontributor.dashboard') }}" class="menu-item {{ request()->is('kontributor/dashboard') ? 'active' : '' }}">
                <i class="bi bi-house"></i> Dashboard
            </a>
            @endif

            {{-- Kelola Organ Tubuh --}}
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('organ.index') }}" class="menu-item {{ request()->is('admin/organ*') ? 'active' : '' }}">
                <i class="bi bi-person"></i> Kelola Organ Tubuh
            </a>
            @elseif(auth()->user()->role === 'kontributor')
            <a href="{{ route('kontributor.organ.index') }}" class="menu-item {{ request()->is('kontributor/organ*') ? 'active' : '' }}">
                <i class="bi bi-person"></i> Kelola Organ Tubuh
            </a>
            @endif

            {{-- Kelola Kategori (Hanya Admin) --}}
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('kategori.index') }}" class="menu-item {{ request()->is('admin/kategori*') ? 'active' : '' }}">
                <i class="bi bi-list-ul"></i> Kelola Kategori
            </a>
            @endif


            {{-- Kelola Quiz --}}
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('quiz.index') }}" class="menu-item {{ request()->is('admin/quiz*') ? 'active' : '' }}">
                <i class="bi bi-pencil"></i> Kelola Quiz
            </a>
            @elseif(auth()->user()->role === 'kontributor')
            <a href="{{ route('kontributor.quiz.index') }}" class="menu-item {{ request()->is('kontributor/quiz*') ? 'active' : '' }}">
                <i class="bi bi-pencil"></i> Kelola Quiz
            </a>
            @endif

            {{-- Kelola Informasi --}}
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('informasi.index') }}" class="menu-item {{ request()->is('admin/informasi*') ? 'active' : '' }}">
                <i class="bi bi-info-circle"></i> Kelola Informasi
            </a>
            @elseif(auth()->user()->role === 'kontributor')
            <a href="{{ route('kontributor.informasi.index') }}" class="menu-item {{ request()->is('kontributor/informasi*') ? 'active' : '' }}">
                <i class="bi bi-info-circle"></i> Kelola Informasi
            </a>
            @endif

            {{-- Kelola Pengguna (Hanya Admin) --}}
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('pengguna.index') }}" class="menu-item {{ request()->is('admin/pengguna*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Kelola Pengguna
            </a>
            @endif

            {{-- Hasil Quiz --}}
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('hasil-quiz.index') }}" class="menu-item {{ request()->is('admin/hasil-quiz*') ? 'active' : '' }}">
                <i class="bi bi-graph-up"></i> Hasil Quiz
            </a>
            @elseif(auth()->user()->role === 'kontributor')
            <a href="{{ route('kontributor.hasil-quiz.index') }}" class="menu-item {{ request()->is('kontributor/hasil-quiz*') ? 'active' : '' }}">
                <i class="bi bi-graph-up"></i> Hasil Quiz
            </a>
            @endif

            <!-- Tombol logout memunculkan modal -->
            <a href="#" class="menu-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="navbar">
                <h3>@yield('title', '')</h3>

                <div class="profile-box">
                    <i class="bi bi-person-circle"></i>
                    <span class="profile-name">{{ Auth::user()->name }}</span>

                    <div class="dropdown-menu">
                        <a href="{{ route('profile.edit') }}">Profil Saya</a>
                    </div>
                </div>
            </div>

            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>


        <!-- Modal Logout -->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body text-center pt-0">
                        <h4 class="fw-bold">Yakin ingin keluar?</h4>

                        <div class="d-flex justify-content-center gap-3 mt-3">
                            <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Batal</button>

                            <!-- ⭐ TOMBOL KELUAR YANG SUDAH PINK -->
                            <button class="btn btn-soft-pink px-4"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Keluar
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            document.querySelector('.profile-box').addEventListener('click', function() {
                this.classList.toggle('open');
            });
        </script>

        @stack('scripts')
</body>

</html>