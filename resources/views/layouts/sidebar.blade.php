<div class="w-64 h-screen bg-white shadow-lg fixed top-0 left-0">
    {{-- Logo atau Judul Panel Admin --}}
    <div class="p-4 border-b flex items-center">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
            <h1 class="text-xl font-bold text-gray-800 ml-3">Admin Panel</h1>
        </a>
    </div>

    {{-- Daftar Link Navigasi --}}
    <nav class="mt-4 px-4">
        <a href="{{ route('dashboard') }}"
           class="flex items-center p-2 my-1 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
            <span class="ms-3">Dashboard</span>
        </a>

        @can('kelola slider')
    <a href="{{ route('dashboard.slide.index') }}" class="flex items-center p-2 my-1 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('dashboard.slide.*') ? 'bg-gray-200 font-semibold' : '' }}">
        <span class="ms-3">Slider Hero</span>
    </a>
    @endcan

        @can('kelola berita')
        <a href="{{ route('dashboard.berita.index') }}"
           class="flex items-center p-2 my-1 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('dashboard.berita.*') ? 'bg-gray-200 font-semibold' : '' }}">
            <span class="ms-3">Kelola Berita</span>
        </a>
        @endcan

        @can('kelola halaman')
        <a href="{{ route('dashboard.agenda.index') }}"
           class="flex items-center p-2 my-1 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('dashboard.agenda.*') ? 'bg-gray-200 font-semibold' : '' }}">
            <span class="ms-3">Kelola Agenda</span>
        </a>
        @endcan

        @can('kelola pejabat')
        <a href="{{ route('dashboard.pejabat.index') }}"
           class="flex items-center p-2 my-1 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('dashboard.pejabat.*') ? 'bg-gray-200 font-semibold' : '' }}">
            <span class="ms-3">Struktur Organisasi</span>
        </a>
        @endcan

        @can('kelola unduhan')
        <a href="{{ route('dashboard.unduhan.index') }}"
           class="flex items-center p-2 my-1 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('dashboard.unduhan.*') ? 'bg-gray-200 font-semibold' : '' }}">
            <span class="ms-3">Kelola Unduhan</span>
        </a>
        @endcan

        @can('kelola galeri')
        <a href="{{ route('dashboard.galeri.index') }}"
           class="flex items-center p-2 my-1 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('dashboard.galeri.*') ? 'bg-gray-200 font-semibold' : '' }}">
            <span class="ms-3">Kelola Galeri</span>
        </a>
        @endcan

        @can('kelola pesan')
        <a href="{{ route('dashboard.pesan.index') }}"
           class="flex items-center p-2 my-1 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('dashboard.pesan.*') ? 'bg-gray-200 font-semibold' : '' }}">
            <span class="ms-3">Kotak Masuk</span>
        </a>
        @endcan

        @can('kelola pengguna')
    <a href="{{ route('dashboard.pengguna.index') }}" class="flex items-center p-2 my-1 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('dashboard.pengguna.*') ? 'bg-gray-200 font-semibold' : '' }}">
        <span class="ms-3">Manajemen Pengguna</span>
    </a>
    @endcan
    </nav>
</div>
