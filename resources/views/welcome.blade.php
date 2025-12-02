<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar Organ Tubuh Manusia</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-pink-50 text-gray-800">

    <!-- Navbar -->
    <nav class="w-full bg-pink-300 text-gray-800 py-4 fixed top-0 left-0 z-50">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <div class="bg-white p-2 rounded-full">
                    🧠
                </div>
                <span class="font-bold text-lg">Belajar Organ Tubuh</span>
            </div>

            <!-- Menu -->
            <ul class="flex space-x-8 text-gray-700 font-medium">
                <li><a href="{{ route('home') }}" class="hover:text-pink-800 transition">Home</a></li>

                {{-- Organ Tubuh - Langsung ke dashboard organ tubuh tanpa perlu login --}}
                <li><a href="{{ route('pengguna.organ.kategori') }}" class="hover:text-pink-800 transition">Organ Tubuh</a></li>

                @auth
                <li><a href="{{ route('pengguna.quiz.index') }}" class="hover:text-pink-800 transition">Quiz</a></li>
                @else
                <li><a href="{{ route('login') }}" class="hover:text-pink-800 transition">Quiz</a></li>
                @endauth

                <li><a href="{{ route('tentang') }}" class="hover:text-pink-800 transition">Tentang</a></li>

                @auth
                <li><a href="{{ url('/dashboard') }}" class="hover:text-pink-800 transition">Dashboard</a></li>
                @else
                <li><a href="{{ route('login') }}" class="hover:text-pink-800 transition">Login</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="min-h-screen bg-pink-100 flex items-center justify-center">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between space-y-10 md:space-y-0">

            <!-- Left Content -->
            <div class="md:w-1/2 space-y-6 text-center md:text-left md:ml-10">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                    Belajar <br> Organ Tubuh <br> Manusia
                </h1>
                <p class="text-lg text-gray-700">
                    Interaktif, Edukatif, dan Mudah Dipahami
                </p>

                {{-- Button Mulai Belajar - Langsung ke dashboard organ tubuh tanpa perlu login --}}
                <a href="{{ route('pengguna.organ.kategori') }}"
                    class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-medium px-6 py-3 rounded-lg shadow transition">
                    Mulai Belajar
                </a>
            </div>

            <!-- Right Image -->
            <div class="md:w-1/2 flex justify-center">
                <img src="{{ asset('images/body-humann.png') }}"
                    alt="Organ Tubuh Manusia"
                    class="w-72 md:w-96 drop-shadow-lg">
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-pink-300 text-gray-700 py-3 text-center fixed bottom-0 left-0 w-full z-50">
        <p class="text-sm">© 2025 Belajar Organ Tubuh Manusia</p>
    </footer>

</body>

</html>