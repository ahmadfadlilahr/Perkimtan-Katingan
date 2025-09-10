@extends('layouts.public')

@section('content')
<div class="bg-white py-12 sm:py-16">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Pusat Unduhan</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">
                Temukan dokumen, formulir, dan berkas publik resmi dari Dinas Perkim.
            </p>
        </div>

        {{-- Search Form --}}
        <div class="mx-auto mt-12 max-w-md">
            <form method="GET" action="{{ route('unduhan.public') }}" class="relative">
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
                        placeholder="Cari dokumen berdasarkan judul atau deskripsi..."
                        class="block w-full pl-10 pr-20 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-colors duration-200"
                        maxlength="100"
                    >
                    <div class="absolute inset-y-0 right-0 flex items-center">
                        @if($search ?? false)
                            <a href="{{ route('unduhan.public') }}"
                               class="mr-2 text-gray-400 hover:text-gray-600 transition-colors duration-200"
                               title="Hapus pencarian">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif
                        <button type="submit"
                                class="mr-1 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200"
                                title="Cari dokumen">
                            Cari
                        </button>
                    </div>
                </div>
            </form>

            @if($search ?? false)
                <div class="mt-4 text-center">
                    <p class="text-sm text-gray-600">
                        Hasil pencarian untuk: <span class="font-semibold text-gray-900">"{{ $search }}"</span>
                        @if($semua_unduhan->total() > 0)
                            <span class="text-indigo-600">({{ $semua_unduhan->total() }} dokumen ditemukan)</span>
                        @else
                            <span class="text-red-600">(tidak ditemukan)</span>
                        @endif
                    </p>
                </div>
            @endif
        </div>

        <div class="mx-auto mt-16 max-w-4xl">
            <ul role="list" class="divide-y divide-gray-200 border-t border-b border-gray-200">
                @forelse ($semua_unduhan as $unduhan)
                    <li class="flex items-center justify-between gap-x-6 py-5 hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex-1">
                            <p class="text-base font-semibold leading-6 text-gray-900">
                                @if($search ?? false)
                                    {!! preg_replace('/(' . preg_quote(trim($search), '/') . ')/i', '<mark class="bg-yellow-200 px-1 rounded">$1</mark>', e($unduhan->judul)) !!}
                                @else
                                    {{ $unduhan->judul }}
                                @endif
                            </p>
                            <p class="mt-1 text-sm leading-5 text-gray-600">
                                @if($search ?? false)
                                    {!! preg_replace('/(' . preg_quote(trim($search), '/') . ')/i', '<mark class="bg-yellow-200 px-1 rounded">$1</mark>', e($unduhan->deskripsi)) !!}
                                @else
                                    {{ $unduhan->deskripsi }}
                                @endif
                            </p>
                            <p class="mt-1 text-xs text-gray-500">
                                Ditambahkan {{ $unduhan->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <a href="{{ asset('storage/unduhan/' . $unduhan->file) }}"
                           target="_blank"
                           class="ml-4 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors duration-200">
                            Unduh
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 ml-2 -mr-1">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v4.59L7.3 9.7a.75.75 0 00-1.1 1.02l3.25 3.5a.75.75 0 001.1 0l3.25-3.5a.75.75 0 10-1.1-1.02l-1.95 2.1V6.75z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                @empty
                    <li class="py-12 text-center">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">
                                @if($search ?? false)
                                    Tidak ada dokumen ditemukan
                                @else
                                    Belum ada dokumen tersedia
                                @endif
                            </h3>
                            <p class="mt-2 text-sm text-gray-500">
                                @if($search ?? false)
                                    Coba gunakan kata kunci yang berbeda atau hapus filter pencarian.
                                @else
                                    Dokumen akan muncul di sini ketika sudah diunggah.
                                @endif
                            </p>
                            @if($search ?? false)
                                <div class="mt-6">
                                    <a href="{{ route('unduhan.public') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Lihat Semua Dokumen
                                    </a>
                                </div>
                            @endif
                        </div>
                    </li>
                @endforelse
            </ul>

            {{-- Pagination --}}
            @if($semua_unduhan->hasPages())
                <div class="mt-8">
                    {{ $semua_unduhan->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
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
