@extends('layouts.public')

@section('content')
    <div class="bg-white py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Semua Berita</h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">
                    Informasi, kegiatan, dan pembaruan terkini dari Dinas Perkim.
                </p>
            </div>

            {{-- Search Form --}}
            <div class="mx-auto mt-12 max-w-md">
                <form method="GET" action="{{ route('berita.index.public') }}" class="relative">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input
                            type="text"
                            name="search"
                            value="{{ $search ?? '' }}"
                            placeholder="Cari berita berdasarkan judul, penulis, atau isi..."
                            class="block w-full pl-10 pr-20 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-colors duration-200"
                            maxlength="100"
                        >
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            @if($search ?? false)
                                <a href="{{ route('berita.index.public') }}"
                                   class="mr-2 text-gray-400 hover:text-gray-600 transition-colors duration-200"
                                   title="Hapus pencarian">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endif
                            <button type="submit"
                                    class="mr-1 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200"
                                    title="Cari berita">
                                Cari
                            </button>
                        </div>
                    </div>
                </form>

                @if($search ?? false)
                    <div class="mt-4 text-center">
                        <p class="text-sm text-gray-600">
                            Hasil pencarian untuk: <span class="font-semibold text-gray-900">"{{ $search }}"</span>
                            @if($beritas->total() > 0)
                                <span class="text-indigo-600">({{ $beritas->total() }} berita ditemukan)</span>
                            @else
                                <span class="text-red-600">(tidak ditemukan)</span>
                            @endif
                        </p>
                    </div>
                @endif
            </div>            {{-- Grid untuk Kartu Berita --}}
            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                {{-- Di dalam file berita/index.blade.php --}}

                @forelse ($beritas as $berita)
                    <article class="flex flex-col items-start justify-between bg-white p-6 rounded-2xl shadow-lg border">
                        <div class="relative w-full">
                            <img src="{{ asset('storage/berita/' . $berita['gambar']) }}" alt="{{ $berita['judul'] }}" class="aspect-[16/9] w-full rounded-xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                            <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                        </div>
                        <div class="max-w-xl flex flex-col flex-grow w-full">
                            <div class="mt-6 flex items-center gap-x-4 text-xs">
                                <time datetime="{{ \Carbon\Carbon::parse($berita['created_at'])->toIso8601String() }}" class="text-gray-500">
                                    {{ \Carbon\Carbon::parse($berita['created_at'])->translatedFormat('d F Y') }}
                                </time>
                            </div>
                            <div class="group relative flex-grow">
                                <h3 class="mt-2 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                    <a href="{{ route('berita.show.public', $berita['slug']) }}">
                                        <span class="absolute inset-0"></span>
                                        {{ $berita['judul'] }}
                                    </a>
                                </h3>
                            </div>
                            <div class="relative mt-4 flex items-center gap-x-2">
                                <div class="text-sm leading-6">
                                    <p class="font-semibold text-gray-900">
                                        Oleh: {{ $berita['penulis'] }}
                                    </p>
                                </div>
                            </div>

                            {{-- 👇👇 TOMBOL BARU DITAMBAHKAN DI SINI 👇👇 --}}
                            <div class="mt-6 flex items-center justify-end w-full">
                                <a href="{{ route('berita.show.public', $berita['slug']) }}" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    Baca Selengkapnya &rarr;
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16l5-3 5 3V4H7z"/>
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">
                                @if($search ?? false)
                                    Tidak ada berita ditemukan
                                @else
                                    Belum ada berita tersedia
                                @endif
                            </h3>
                            <p class="mt-2 text-sm text-gray-500">
                                @if($search ?? false)
                                    Coba gunakan kata kunci yang berbeda atau hapus filter pencarian.
                                @else
                                    Berita akan muncul di sini ketika sudah dipublikasikan.
                                @endif
                            </p>
                            @if($search ?? false)
                                <div class="mt-6">
                                    <a href="{{ route('berita.index.public') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Lihat Semua Berita
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Link Paginasi --}}
            @if($beritas->hasPages())
                <div class="mt-16">
                    {{ $beritas->appends(request()->query())->links() }}
                </div>
            @endif

        </div>
    </div>

    {{-- Enhanced Search Experience --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="search"]');
            const searchForm = searchInput.closest('form');

            // Auto-focus search input if there's a search term
            if (searchInput.value.trim()) {
                searchInput.focus();
                searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
            }

            // Submit form on Enter key
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    if (searchInput.value.trim()) {
                        searchForm.submit();
                    }
                }
            });

            // Clear search shortcut (Escape key)
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    searchInput.value = '';
                    searchInput.blur();
                }
            });
        });
    </script>
@endsection
