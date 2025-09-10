<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Login Page Title --}}
        <title>Admin Login - {{ config('app.name', 'Dinas Perumahan dan Permukiman') }}</title>

        {{-- Favicon dengan Logo Dinas --}}
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-dinas.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo-dinas.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo-dinas.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Background Pattern -->
        <div class="h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 overflow-hidden">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 32 32%27 width=%2732%27 height=%2732%27 fill=%27none%27 stroke=%27rgb(99 102 241 / 0.03)%27%3e%3cpath d=%27m0 .5 32 32M32 .5 0 32%27/%3e%3c/svg%3e')] opacity-30"></div>

            <!-- Main Content -->
            <div class="relative h-full flex flex-col justify-center items-center px-4">
                <!-- Logo Section -->
                <div class="mb-6 text-center">
                    <a href="/" class="inline-flex items-center">
                        <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center shadow-xl p-3">
                            <img src="{{ asset('images/logo-dinas.png') }}"
                                 alt="Logo Dinas Perumahan dan Permukiman"
                                 class="w-14 h-14 object-contain">
                        </div>
                    </a>
                    <div class="mt-3">
                        <x-ui.text-gradient variant="primary" size="xl" as="h1" class="mb-1">
                            Admin Portal
                        </x-ui.text-gradient>
                        <p class="text-xs text-gray-600">Dinas Perumahan dan Kawasan Permukiman</p>
                    </div>
                </div>

                <!-- Login Card -->
                <div class="w-full sm:max-w-md flex-shrink-0">
                    <div class="bg-white/80 backdrop-blur-sm shadow-2xl border border-white/20 overflow-hidden sm:rounded-2xl">
                        <div class="px-6 py-5">
                            {{ $slot }}
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-3 text-center">
                    <p class="text-xs text-gray-500">
                        © {{ date('Y') }} Dinas Perumahan dan Kawasan Permukiman
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
