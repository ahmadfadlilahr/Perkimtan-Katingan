{{-- resources/views/components/admin/sidebar.blade.php --}}
<!-- Desktop sidebar -->
<div class="hidden lg:block w-64 h-screen bg-white shadow-lg border-r border-gray-200/60 fixed top-0 left-0 z-30">
    {{-- Logo Header --}}
    <div class="p-6 border-b border-gray-100/80">
        <a href="{{ route('dashboard') }}" class="flex items-center group">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center mr-3 p-1 shadow-lg group-hover:scale-105 transition-transform">
                <img src="{{ asset('images/logo-dinas.png') }}"
                     alt="Logo Dinas"
                     class="w-8 h-8 object-contain">
            </div>
            <div>
                <h1 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors">Admin Panel</h1>
                <p class="text-xs text-gray-500 font-medium">Dinas Perkim</p>
            </div>
        </a>
    </div>

    {{-- Navigation Menu --}}
    <nav class="p-4 space-y-2 overflow-y-auto" style="height: calc(100vh - 140px);">
        {{-- Dashboard --}}
        <x-admin.sidebar-link
            href="{{ route('dashboard') }}"
            :active="request()->routeIs('dashboard')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v3H8V5z"></path></svg>'>
            Dashboard
        </x-admin.sidebar-link>

        @can('kelola slider')
        <x-admin.sidebar-link
            href="{{ route('dashboard.slide.index') }}"
            :active="request()->routeIs('dashboard.slide.*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>'>
            Slider Hero
        </x-admin.sidebar-link>
        @endcan

        @can('kelola berita')
        <x-admin.sidebar-link
            href="{{ route('dashboard.berita.index') }}"
            :active="request()->routeIs('dashboard.berita.*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path></svg>'>
            Kelola Berita
        </x-admin.sidebar-link>
        @endcan

        @can('kelola agenda')
        <x-admin.sidebar-link
            href="{{ route('dashboard.agenda.index') }}"
            :active="request()->routeIs('dashboard.agenda.*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0h6m-6 0l-1 9a2 2 0 002 2h4a2 2 0 002-2l-1-9m-6 0h6M9 3v2m6-2v2"></path></svg>'>
            Kelola Agenda
        </x-admin.sidebar-link>
        @endcan

        @can('kelola pejabat')
        <x-admin.sidebar-link
            href="{{ route('dashboard.pejabat.index') }}"
            :active="request()->routeIs('dashboard.pejabat.*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>'>
            Struktur Organisasi
        </x-admin.sidebar-link>
        @endcan

        @can('kelola halaman')
        <x-admin.sidebar-link
            href="{{ route('dashboard.visi-misi.index') }}"
            :active="request()->routeIs('dashboard.visi-misi.*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>'>
            Visi & Misi
        </x-admin.sidebar-link>
        @endcan

        @can('kelola unduhan')
        <x-admin.sidebar-link
            href="{{ route('dashboard.unduhan.index') }}"
            :active="request()->routeIs('dashboard.unduhan.*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>'>
            Kelola Unduhan
        </x-admin.sidebar-link>
        @endcan

        @can('kelola galeri')
        <x-admin.sidebar-link
            href="{{ route('dashboard.galeri.index') }}"
            :active="request()->routeIs('dashboard.galeri.*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>'>
            Kelola Galeri
        </x-admin.sidebar-link>
        @endcan

        @can('kelola pesan')
        <x-admin.sidebar-link
            href="{{ route('dashboard.pesan.index') }}"
            :active="request()->routeIs('dashboard.pesan.*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>'
            :badge="$pesanBelumDibaca ?? 0">
            Kotak Masuk
        </x-admin.sidebar-link>
        @endcan

        @can('kelola pengguna')
        <x-admin.sidebar-link
            href="{{ route('dashboard.pengguna.index') }}"
            :active="request()->routeIs('dashboard.pengguna.*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path></svg>'>
            Manajemen Pengguna
        </x-admin.sidebar-link>
        @endcan
    </nav>

    {{-- Footer Info --}}
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-100/80">
        <div class="text-center">
            <p class="text-xs text-gray-500">
                © {{ date('Y') }} Dinas Perkim
            </p>
            <p class="text-xs text-gray-400 mt-1">
                v1.0.0
            </p>
        </div>
    </div>
</div>

<!-- Mobile sidebar -->
<div x-show="sidebarOpen"
     x-transition:enter="transition ease-in-out duration-300 transform"
     x-transition:enter-start="-translate-x-full"
     x-transition:enter-end="translate-x-0"
     x-transition:leave="transition ease-in-out duration-300 transform"
     x-transition:leave-start="translate-x-0"
     x-transition:leave-end="-translate-x-full"
     class="lg:hidden fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg border-r border-gray-200/60"
     style="display: none;">

    <!-- Mobile sidebar header with close button -->
    <div class="flex items-center justify-between p-4 border-b border-gray-100/80">
        <a href="{{ route('dashboard') }}" class="flex items-center group">
            <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center mr-2 p-1 shadow-lg">
                <img src="{{ asset('images/logo-dinas.png') }}"
                     alt="Logo Dinas"
                     class="w-6 h-6 object-contain">
            </div>
            <div>
                <h1 class="text-base font-bold text-gray-900">Admin Panel</h1>
                <p class="text-xs text-gray-500">Dinas Perkim</p>
            </div>
        </a>

        <button @click="sidebarOpen = false"
                class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
            <span class="sr-only">Close sidebar</span>
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    {{-- Mobile Navigation Menu --}}
    <nav class="p-3 space-y-1 overflow-y-auto" style="height: calc(100vh - 120px);">
        {{-- Dashboard --}}
        <x-admin.sidebar-link
            href="{{ route('dashboard') }}"
            :active="request()->routeIs('dashboard')"
            icon='<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v3H8V5z"></path></svg>'
            :mobile="true">
            Dashboard
        </x-admin.sidebar-link>

        @can('kelola slider')
        <x-admin.sidebar-link
            href="{{ route('dashboard.slide.index') }}"
            :active="request()->routeIs('dashboard.slide.*')"
            icon='<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>'
            :mobile="true">
            Slider Hero
        </x-admin.sidebar-link>
        @endcan

        @can('kelola berita')
        <x-admin.sidebar-link
            href="{{ route('dashboard.berita.index') }}"
            :active="request()->routeIs('dashboard.berita.*')"
            icon='<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path></svg>'
            :mobile="true">
            Kelola Berita
        </x-admin.sidebar-link>
        @endcan

        @can('kelola agenda')
        <x-admin.sidebar-link
            href="{{ route('dashboard.agenda.index') }}"
            :active="request()->routeIs('dashboard.agenda.*')"
            icon='<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0h6m-6 0l-1 9a2 2 0 002 2h4a2 2 0 002-2l-1-9m-6 0h6M9 3v2m6-2v2"></path></svg>'
            :mobile="true">
            Kelola Agenda
        </x-admin.sidebar-link>
        @endcan

        @can('kelola pejabat')
        <x-admin.sidebar-link
            href="{{ route('dashboard.pejabat.index') }}"
            :active="request()->routeIs('dashboard.pejabat.*')"
            icon='<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>'
            :mobile="true">
            Struktur Organisasi
        </x-admin.sidebar-link>
        @endcan

        @can('kelola halaman')
        <x-admin.sidebar-link
            href="{{ route('dashboard.visi-misi.index') }}"
            :active="request()->routeIs('dashboard.visi-misi.*')"
            icon='<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>'
            :mobile="true">
            Visi & Misi
        </x-admin.sidebar-link>
        @endcan

        @can('kelola unduhan')
        <x-admin.sidebar-link
            href="{{ route('dashboard.unduhan.index') }}"
            :active="request()->routeIs('dashboard.unduhan.*')"
            icon='<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>'
            :mobile="true">
            Kelola Unduhan
        </x-admin.sidebar-link>
        @endcan

        @can('kelola galeri')
        <x-admin.sidebar-link
            href="{{ route('dashboard.galeri.index') }}"
            :active="request()->routeIs('dashboard.galeri.*')"
            icon='<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>'
            :mobile="true">
            Kelola Galeri
        </x-admin.sidebar-link>
        @endcan

        @can('kelola pesan')
        <x-admin.sidebar-link
            href="{{ route('dashboard.pesan.index') }}"
            :active="request()->routeIs('dashboard.pesan.*')"
            icon='<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>'
            :badge="$pesanBelumDibaca ?? 0"
            :mobile="true">
            Kotak Masuk
        </x-admin.sidebar-link>
        @endcan

        @can('kelola pengguna')
        <x-admin.sidebar-link
            href="{{ route('dashboard.pengguna.index') }}"
            :active="request()->routeIs('dashboard.pengguna.*')"
            icon='<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path></svg>'
            :mobile="true">
            Manajemen Pengguna
        </x-admin.sidebar-link>
        @endcan
    </nav>

    {{-- Mobile Footer Info --}}
    <div class="absolute bottom-0 left-0 right-0 p-3 border-t border-gray-100/80">
        <div class="text-center">
            <p class="text-xs text-gray-500">
                © {{ date('Y') }} Dinas Perkim
            </p>
        </div>
    </div>
</div>
