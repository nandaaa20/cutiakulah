<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center">
    <div class="w-full sm:max-w-md mx-auto px-6 py-8 bg-white shadow-2xl rounded-xl">
        <div class="flex flex-col items-center mb-6">
            <h1 class="mt-4 text-2xl font-bold text-gray-800">{{ config('app.name', 'Laravel') }}</h1>
        </div>

        {{ $slot }}
    </div>
</body>
</html>
