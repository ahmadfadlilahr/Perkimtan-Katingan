<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- ... bagian head tetap sama ... --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">

        {{-- Admin Dashboard Title --}}
        <title>
            @hasSection('title')
                @yield('title') - Dashboard Admin - {{ config('app.name', 'Dinas Perumahan dan Permukiman') }}
            @else
                Dashboard Admin - {{ config('app.name', 'Dinas Perumahan dan Permukiman') }}
            @endif
        </title>

        {{-- Favicon dengan Logo Dinas --}}
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-dinas.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo-dinas.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo-dinas.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Alpine.js untuk interactivity --}}
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

        {{-- TinyMCE Self-Hosted (No domain registration required) --}}
        <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
    </head>
    <body class="font-sans antialiased bg-gray-50/50" x-data="{ sidebarOpen: false }" @keydown.escape="sidebarOpen = false">

        {{-- Admin Loading Screen Component --}}
        <x-admin-loading-screen />

        <div class="min-h-screen flex">
            <!-- Mobile sidebar backdrop -->
            <div x-show="sidebarOpen"
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-40 lg:hidden"
                 style="display: none;">
                <div class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="sidebarOpen = false"></div>
            </div>

            <x-admin.sidebar />

            <div class="flex-1 flex flex-col lg:ml-64">
                {{-- Top Navigation Header --}}
                <header class="bg-white border-b border-gray-200/60 h-16 flex items-center justify-between px-4 lg:px-6 shadow-sm">
                    <!-- Mobile menu button -->
                    <button @click="sidebarOpen = true"
                            class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <div class="flex-1 lg:ml-0">
                        @isset($header)
                            {{ $header }}
                        @endisset
                    </div>

                    <div class="flex items-center">
                        @include('layouts.navigation')
                    </div>
                </header>

                {{-- Main Content --}}
                <main class="flex-1 overflow-y-auto bg-gray-50/50">
                    {{ $slot }}
                </main>
            </div>
        </div>
        @stack('scripts')
    </body>
</html>
