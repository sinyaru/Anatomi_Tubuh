<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang - Belajar Organ Tubuh</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .content-wrapper {
            flex: 1;
        }
    </style>
</head>

<body class="bg-pink-50 text-gray-800">

    <!-- Navbar -->
    <nav class="w-full bg-pink-300 text-gray-800 py-4 shadow-md">
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
                
                @auth
                    <li><a href="{{ route('pengguna.organ.index') }}" class="hover:text-pink-800 transition">Organ Tubuh</a></li>
                    <li><a href="{{ route('pengguna.quiz.index') }}" class="hover:text-pink-800 transition">Quiz</a></li>
                @else
                    <li><a href="{{ route('login.pengguna') }}" class="hover:text-pink-800 transition">Organ Tubuh</a></li>
                    <li><a href="{{ route('login.pengguna') }}" class="hover:text-pink-800 transition">Quiz</a></li>
                @endauth
                
                <li><a href="{{ route('tentang') }}" class="hover:text-pink-800 transition font-bold text-pink-800">Tentang</a></li>
                
                @auth
                    <li><a href="{{ url('/dashboard') }}" class="hover:text-pink-800 transition">Dashboard</a></li>
                @else
                    <li><a href="{{ route('login.pengguna') }}" class="hover:text-pink-800 transition">Login</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="max-w-7xl mx-auto px-6 py-12">
            <h1 class="text-2xl font-bold text-gray-900 mb-8">Informasi Mengenai Website</h1>

            @forelse($informasi as $info)
                <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
                    <!-- Header Card -->
                    <div class="bg-pink-500 px-6 py-3">
                        <h2 class="text-xl font-bold text-white">{{ $info->judul }}</h2>
                    </div>
                    
                    <!-- Table Content -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <tbody>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-semibold text-gray-700 w-1/4 bg-gray-50">Deskripsi</td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {!! nl2br(e($info->deskripsi)) !!}
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-semibold text-gray-700 bg-gray-50">Tanggal</td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ \Carbon\Carbon::parse($info->tanggal)->format('d M Y') }}
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-semibold text-gray-700 bg-gray-50">Dibuat oleh</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-pink-100 text-pink-700 px-4 py-1 rounded-full text-sm font-semibold uppercase">
                                            {{ $info->role }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <div class="text-5xl mb-4">📝</div>
                    <p class="text-lg text-gray-600">Belum ada informasi yang tersedia.</p>
                    <p class="text-gray-500 mt-2">Silakan cek kembali nanti.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-pink-300 text-gray-700 py-4 text-center mt-auto">
        <p class="text-sm font-semibold">© 2025 Belajar Organ Tubuh Manusia</p>
    </footer>

</body>

</html>