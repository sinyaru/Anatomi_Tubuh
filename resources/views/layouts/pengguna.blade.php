<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Pengguna')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            overflow: hidden;
        }

        /* Sidebar */
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

        /* Navbar */
        .navbar {
            background-color: #f8bbd0;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #4a4a4a;
            position: relative;
        }

        .navbar h3 {
            margin: 0;
            font-weight: 600;
        }

        .user-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            cursor: pointer;
            background: none;
            border: none;
            color: #4a4a4a;
        }

        .user-dropdown-toggle i {
            background-color: #ec407a;
            color: white;
            padding: 8px;
            border-radius: 50%;
        }

        .dropdown-menu {
            border-radius: 8px;
            min-width: 150px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Content */
        .main-content {
            flex: 1;
            background-color: #fffafc;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .content-wrapper {
            padding: 25px 40px;
            flex: 1;
        }

        .btn-soft-pink {
            background-color: #ec407a;
            color: white;
            border: none;
            transition: 0.3s;
        }

        .btn-soft-pink:hover {
            background-color: #d81b60;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                flex-direction: row;
                justify-content: space-around;
                padding: 10px;
            }

            .navbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .content-wrapper {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">

        <!-- Sidebar -->
        <div class="sidebar">
            {{-- MENU KEMBALI KE HOME --}}
            <a href="{{ route('home') }}"
                class="menu-item">
                <i class="bi bi-house-door"></i> Kembali ke Home
            </a>

            @auth
            <a href="{{ route('pengguna.dashboard') }}"
                class="menu-item {{ request()->routeIs('pengguna.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house"></i> Dashboard
            </a>
            @endauth

            <a href="{{ route('pengguna.organ.kategori') }}"
                class="menu-item {{ request()->routeIs('pengguna.organ.*') ? 'active' : '' }}">
                <i class="bi bi-book"></i> Organ Tubuh
            </a>

            @auth
            <a href="{{ route('pengguna.quiz.index') }}"
                class="menu-item {{ request()->routeIs('pengguna.quiz.*') ? 'active' : '' }}">
                <i class="bi bi-puzzle"></i> Quiz Interaktif
            </a>

            <a href="{{ route('pengguna.hasil-quiz.index') }}"
                class="menu-item {{ request()->routeIs('pengguna.hasil-quiz.*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart"></i> Hasil Quiz
            </a>

            <!-- Tombol Logout di Sidebar -->
            <a href="#" class="menu-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            @else
            <!-- Tombol Login untuk Guest -->
            <a href="{{ route('login') }}" class="menu-item">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
            @endauth
        </div>

        <!-- Main Content -->
        <div class="main-content">

            <!-- Navbar -->
            <div class="navbar">
                <h3>
                    @if(View::hasSection('title'))
                    @yield('title')
                    @else
                    @auth
                    Selamat Datang, {{ Auth::user()->name }}
                    @else
                    Selamat Datang
                    @endauth
                    @endif
                </h3>

                @auth
                <div class="d-flex align-items-center gap-4">
                    <!-- DROPDOWN PROFIL -->
                    <div class="dropdown">
                        <button class="user-dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('pengguna.profil') }}">
                                    <i class="bi bi-person me-2"></i> Profil Saya
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                @endauth
            </div>

            <!-- Page Content -->
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>

    @auth
    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center pt-0">
                    <h4 class="fw-bold">Yakin ingin keluar?</h4>

                    <div class="d-flex justify-content-center gap-3 mt-3">
                        <button class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Batal</button>

                        <!-- Tombol Keluar yang aman -->
                        <button type="button" class="btn btn-soft-pink px-4" id="confirmLogout">Keluar</button>

                        <!-- Form Logout Tersembunyi -->
                        <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Submit form logout saat tombol Keluar ditekan
        document.getElementById('confirmLogout').addEventListener('click', function() {
            document.getElementById('logoutForm').submit();
        });
    </script>
    @endauth

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>