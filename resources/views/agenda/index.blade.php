@extends('layouts.public')

@section('title', 'Agenda Kegiatan - Dinas Perkim')

@section('content')
<div class="min-h-screen bg-white">
    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-gray-50 to-gray-100 py-16 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Agenda Kegiatan
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Jadwal kegiatan dan acara yang diselenggarakan oleh Dinas Perkim
                </p>
            </div>
        </div>
    </section>

    {{-- Main Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Main Content Area --}}
            <div class="lg:col-span-2">
                {{-- Featured Agendas --}}
                @if($featuredAgendas->count() > 0)
                    <section class="mb-12">
                        <div class="mb-8">
                            <h2 class="text-3xl font-bold text-gray-900 mb-2">Agenda Unggulan</h2>
                            <p class="text-gray-600">Agenda penting yang perlu Anda ketahui</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($featuredAgendas as $agenda)
                                <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-200">
                                    <div class="mb-4">
                                        <div class="flex flex-wrap gap-2 mb-3">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                ⭐ Unggulan
                                            </span>
                                            @if($agenda->kategori === 'rapat')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Rapat
                                                </span>
                                            @elseif($agenda->kategori === 'sosialisasi')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                    Sosialisasi
                                                </span>
                                            @elseif($agenda->kategori === 'workshop')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Workshop
                                                </span>
                                            @elseif($agenda->kategori === 'acara_publik')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                    Acara Publik
                                                </span>
                                            @endif

                                            @if($agenda->prioritas === 'tinggi')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Tinggi
                                                </span>
                                            @elseif($agenda->prioritas === 'sedang')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Sedang
                                                </span>
                                            @elseif($agenda->prioritas === 'rendah')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Rendah
                                                </span>
                                            @endif
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                            <a href="{{ route('agenda.show.public', $agenda->slug) }}" class="hover:text-blue-600 transition-colors">
                                                {{ $agenda->judul }}
                                            </a>
                                        </h3>
                                    </div>

                                    <div class="space-y-2 text-sm text-gray-600 mb-4">
                                        <div class="flex items-center">
                                            <span class="mr-2">📅</span>
                                            {{ \Carbon\Carbon::parse($agenda->tanggal_agenda)->format('d F Y') }}
                                        </div>
                                        @if($agenda->waktu_mulai)
                                            <div class="flex items-center">
                                                <span class="mr-2">🕐</span>
                                                {{ \Carbon\Carbon::parse($agenda->waktu_mulai)->format('H:i') }} WIB
                                            </div>
                                        @endif
                                        @if($agenda->lokasi)
                                            <div class="flex items-center">
                                                <span class="mr-2">📍</span>
                                                {{ Str::limit($agenda->lokasi, 40) }}
                                            </div>
                                        @endif
                                    </div>

                                    <a href="{{ route('agenda.show.public', $agenda->slug) }}"
                                       class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700">
                                        Lihat detail →
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- All Agendas --}}
                <section>
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Semua Agenda</h2>
                        <p class="text-gray-600">Daftar lengkap agenda kegiatan terkini</p>
                    </div>

                    @if($agendas->count() > 0)
                        <div class="space-y-6">
                            @foreach($agendas as $agenda)
                                <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-200">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex-1">
                                            <div class="flex flex-wrap gap-2 mb-3">
                                                @if($agenda->kategori === 'rapat')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        Rapat
                                                    </span>
                                                @elseif($agenda->kategori === 'sosialisasi')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                        Sosialisasi
                                                    </span>
                                                @elseif($agenda->kategori === 'workshop')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Workshop
                                                    </span>
                                                @elseif($agenda->kategori === 'acara_publik')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                        Acara Publik
                                                    </span>
                                                @endif

                                                @if($agenda->prioritas === 'tinggi')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        Tinggi
                                                    </span>
                                                @elseif($agenda->prioritas === 'sedang')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        Sedang
                                                    </span>
                                                @elseif($agenda->prioritas === 'rendah')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Rendah
                                                    </span>
                                                @endif

                                                @if($agenda->is_featured)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        ⭐ Unggulan
                                                    </span>
                                                @endif
                                            </div>
                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                                <a href="{{ route('agenda.show.public', $agenda->slug) }}" class="hover:text-blue-600 transition-colors">
                                                    {{ $agenda->judul }}
                                                </a>
                                            </h3>
                                        </div>
                                    </div>

                                    <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-3">
                                        <span class="flex items-center">
                                            <span class="mr-1">📅</span>
                                            {{ \Carbon\Carbon::parse($agenda->tanggal_agenda)->format('d M Y') }}
                                        </span>
                                        @if($agenda->waktu_mulai)
                                            <span class="flex items-center">
                                                <span class="mr-1">🕐</span>
                                                {{ \Carbon\Carbon::parse($agenda->waktu_mulai)->format('H:i') }} WIB
                                            </span>
                                        @endif
                                        @if($agenda->lokasi)
                                            <span class="flex items-center">
                                                <span class="mr-1">📍</span>
                                                {{ Str::limit($agenda->lokasi, 30) }}
                                            </span>
                                        @endif
                                    </div>

                                    @if($agenda->konten)
                                        <div class="text-gray-600 mb-4 text-sm">
                                            {!! Str::limit(strip_tags($agenda->konten), 120) !!}
                                        </div>
                                    @endif

                                    <div class="flex items-center justify-between">
                                        <a href="{{ route('agenda.show.public', $agenda->slug) }}"
                                           class="text-sm font-medium text-blue-600 hover:text-blue-700">
                                            Lihat Detail →
                                        </a>
                                        @if($agenda->lampiran)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                📎 Lampiran
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        @if($agendas->hasPages())
                            <div class="mt-8">
                                {{ $agendas->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-12">
                            <div class="text-6xl mb-4">📅</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada agenda</h3>
                            <p class="text-gray-600">Agenda kegiatan akan segera dipublikasikan.</p>
                        </div>
                    @endif
                </section>
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-lg p-6">
                    {{-- Filter & Search --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter & Pencarian</h3>
                        <form method="GET" action="{{ route('agenda.index.public') }}" class="space-y-4">
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Agenda</label>
                                <input type="text"
                                       id="search"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Masukkan kata kunci..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <select id="category"
                                        name="category"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Semua Kategori</option>
                                    <option value="rapat" {{ request('category') == 'rapat' ? 'selected' : '' }}>Rapat</option>
                                    <option value="sosialisasi" {{ request('category') == 'sosialisasi' ? 'selected' : '' }}>Sosialisasi</option>
                                    <option value="workshop" {{ request('category') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                                    <option value="acara_publik" {{ request('category') == 'acara_publik' ? 'selected' : '' }}>Acara Publik</option>
                                </select>
                            </div>

                            <button type="submit"
                                    class="w-full bg-gray-900 text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                                🔍 Terapkan Filter
                            </button>
                        </form>
                    </div>

                    {{-- Upcoming Events --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Agenda Mendatang</h3>
                        @forelse($featuredAgendas->take(3) as $upcoming)
                            <div class="border-l-4 border-gray-300 pl-3 py-3 bg-gray-100 rounded-r-md mb-3">
                                <div class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    {{ \Carbon\Carbon::parse($upcoming->tanggal_agenda)->format('d M Y') }}
                                </div>
                                <div class="text-sm font-medium text-gray-900 mt-1">
                                    <a href="{{ route('agenda.show.public', $upcoming->slug) }}"
                                       class="hover:text-blue-600 transition-colors">
                                        {{ Str::limit($upcoming->judul, 40) }}
                                    </a>
                                </div>
                                @if($upcoming->waktu_mulai)
                                    <div class="text-xs text-gray-500 mt-1">
                                        🕐 {{ \Carbon\Carbon::parse($upcoming->waktu_mulai)->format('H:i') }} WIB
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-4 text-sm text-gray-500">
                                📅 Belum ada agenda mendatang
                            </div>
                        @endforelse
                    </div>

                    {{-- Quick Info --}}
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi</h3>
                        <div class="text-sm text-gray-600 space-y-2 mb-4">
                            <p>Halaman ini menampilkan agenda kegiatan yang diselenggarakan oleh Dinas Perkim.</p>
                            <p>Untuk informasi lebih lanjut, silakan hubungi kami.</p>
                        </div>
                        <a href="{{ route('kontak.public') }}"
                           class="inline-flex items-center w-full justify-center px-4 py-2 bg-blue-50 text-blue-700 text-sm font-medium rounded-md hover:bg-blue-100 transition-colors">
                            ✉️ Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
