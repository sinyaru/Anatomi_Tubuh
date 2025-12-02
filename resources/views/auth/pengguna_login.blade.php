<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengguna | Anatomi Tubuh</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-pink-100 flex justify-center items-center min-h-screen">

    <div class="bg-white flex rounded-2xl shadow-lg overflow-hidden w-[900px]">
        <!-- Bagian kiri (gambar anatomi) -->
        <div class="w-1/2 flex items-center justify-center bg-white p-6">
            <img src="{{ asset('images/body-diagrammm.jpg') }}" alt="Ilustrasi Anatomi" class="w-72">
        </div>

        <!-- Bagian kanan (form login) -->
        <div class="w-1/2 bg-pink-200 p-10 flex flex-col justify-center">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">LOGIN PENGGUNA</h2>

            @if (session('success'))
                <div class="text-center mb-4 text-green-600 font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="text-center mb-4 text-red-600 font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.pengguna.submit') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-800 mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full border border-pink-300 rounded-lg px-3 py-2 focus:ring focus:ring-pink-300 focus:border-pink-400">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-800 mb-1">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full border border-pink-300 rounded-lg px-3 py-2 focus:ring focus:ring-pink-300 focus:border-pink-400">
                </div>

                <button type="submit"
                    class="w-full bg-pink-400 text-white py-2 rounded-lg hover:bg-pink-500 transition">
                    Login
                </button>

                <p class="text-sm text-center text-gray-700 mt-4">
                    Kembali ke login admin?
                    <a href="{{ route('login') }}" class="text-pink-600 hover:underline font-medium">Klik di sini</a>
                </p>
            </form>
        </div>
    </div>

</body>

</html>