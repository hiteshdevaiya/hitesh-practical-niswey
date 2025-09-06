<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ Vite::asset('resources/images/logo.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased font-sans bg-gray-50 min-h-screen flex flex-col">

    <!-- Page content -->
    <div class="flex-1">
        {{ $slot }}
    </div>

    <!-- Footer -->
    <footer class="w-full bg-yellow-500 text-white py-4 text-center text-sm">
        © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </footer>

    @livewireScripts
</body>
</html>
