<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Percutian - Maintenance</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gradient-to-br from-yellow-400 via-orange-500 to-red-500 min-h-screen flex flex-col items-center justify-center text-white">

    <!-- Header -->
    <div class="absolute top-4 right-4 flex gap-3">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="bg-white text-orange-600 px-4 py-2 rounded-lg font-semibold shadow hover:bg-gray-100 transition">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="bg-white text-orange-600 px-4 py-2 rounded-lg font-semibold shadow hover:bg-gray-100 transition">
                    Login
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-white text-orange-600 px-4 py-2 rounded-lg font-semibold shadow hover:bg-gray-100 transition">
                        Register
                    </a>
                @endif
            @endauth
        @endif
    </div>

    <!-- Main Content -->
    <div class="text-center px-6">
        <img src="{{ asset('logo.png') }}" alt="Logo Percutian" class="mx-auto w-28 h-28 mb-6 animate-bounce">
        <h1 class="text-4xl font-bold mb-2">🚧 Maintenance Mode</h1>
        <p class="text-lg opacity-90 mb-6">
            Sistem sedang dalam perawatan untuk meningkatkan kualitas layanan.  
            Beberapa fitur mungkin tidak tersedia sementara.
        </p>

        <div class="flex items-center justify-center gap-3 text-sm opacity-80">
            <span>Terakhir diperbarui: {{ now()->translatedFormat('d F Y H:i') }}</span>
        </div>
    </div>

    <!-- Footer -->
    <footer class="absolute bottom-4 text-xs opacity-70">
        &copy; {{ date('Y') }} Percutian | Laravel v{{ Illuminate\Foundation\Application::VERSION }}
    </footer>

</body>
</html>
