<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col space-y-2">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">
                Kelola Galeri
            </h2>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Page Title & Add Button --}}
            <div class="mb-6 flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Kelola koleksi foto dan gambar galeri</h1>
                </div>
                <div>
                    <a href="{{ route('dashboard.galeri.create') }}"
                       class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-2 bg-purple-600 hover:bg-purple-700 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambah
                    </a>
                </div>
            </div>

            {{-- Search Section --}}
            <div class="mb-6 bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
                <form method="GET" action="{{ route('dashboard.galeri.index') }}" class="space-y-4">
                    <div class="flex flex-col sm:flex-row gap-4">
                        {{-- Search Input --}}
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input type="text"
                                       name="search"
                                       value="{{ $search }}"
                                       class="block w-full pl-10 pr-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200"
                                       placeholder="Cari berdasarkan keterangan foto...">
                            </div>
                        </div>

                        {{-- Search Button --}}
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                            <button type="submit"
                                    class="inline-flex items-center justify-center px-6 py-2.5 bg-purple-600 hover:bg-purple-700 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Cari
                            </button>

                            @if($search)
                            <a href="{{ route('dashboard.galeri.index') }}"
                               class="inline-flex items-center justify-center px-4 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Reset
                            </a>
                            @endif
                        </div>
                    </div>

                    {{-- Search Info --}}
                    @if($search)
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Menampilkan hasil pencarian untuk: <span class="font-semibold text-purple-600">"{{ $search }}"</span>
                        <span class="ml-2 text-gray-500">
                            ({{ $semua_galeri->total() }} {{ Str::plural('foto', $semua_galeri->total()) }})
                        </span>
                    </div>
                    @endif
                </form>
            </div>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Gallery Grid --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                {{-- Header --}}
                <div class="border-b border-gray-200 bg-gray-50 px-4 sm:px-6 py-4">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-3 sm:space-y-0">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">
                                    Galeri Foto
                                </h3>
                                <p class="text-sm text-gray-600">
                                    Total {{ $semua_galeri->total() }} {{ Str::plural('foto', $semua_galeri->total()) }}
                                </p>
                            </div>
                        </div>

                        <div class="text-sm text-gray-500">
                            <span class="hidden sm:inline">{{ $semua_galeri->currentPage() }}/{{ $semua_galeri->lastPage() }}</span>
                            <span class="sm:hidden">{{ $semua_galeri->currentPage() }}/{{ $semua_galeri->lastPage() }}</span>
                        </div>
                    </div>
                </div>

                {{-- Gallery Content --}}
                <div class="p-4 sm:p-6">
                    @forelse ($semua_galeri as $item)
                        @if($loop->first)
                        <div class="grid grid-cols-1 gap-4 sm:gap-6">
                        @endif

                        {{-- Mobile Card Layout (visible on mobile, hidden on desktop) --}}
                        <div class="lg:hidden bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-start space-x-4">
                                {{-- Image --}}
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('storage/galeri/' . $item->gambar) }}"
                                         alt="{{ $item->keterangan }}"
                                         class="w-16 h-16 object-cover rounded-lg">
                                </div>

                                {{-- Content --}}
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 line-clamp-2 mb-2">
                                        {{ $item->keterangan ?? 'Tanpa keterangan' }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="text-xs text-gray-500">
                                            <div>{{ $item->created_at->format('d M Y') }}</div>
                                            <div>{{ $item->created_at->diffForHumans() }}</div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('dashboard.galeri.edit', $item) }}"
                                               class="inline-flex items-center px-2 py-1 bg-purple-100 hover:bg-purple-200 text-purple-700 text-xs font-medium rounded-md transition-colors duration-200">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('dashboard.galeri.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center px-2 py-1 bg-red-100 hover:bg-red-200 text-red-700 text-xs font-medium rounded-md transition-colors duration-200">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Desktop Grid Layout (hidden on mobile, visible on desktop) --}}
                        <div class="hidden lg:block">
                            @if($loop->first)
                            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                            @endif

                            <div class="group bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                                {{-- Image Container --}}
                                <div class="relative overflow-hidden">
                                    <img src="{{ asset('storage/galeri/' . $item->gambar) }}"
                                         alt="{{ $item->keterangan }}"
                                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">

                                    {{-- Image Overlay --}}
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <div class="absolute bottom-4 left-4 right-4">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('dashboard.galeri.edit', $item) }}"
                                                   class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-white/90 backdrop-blur-sm hover:bg-white border border-white/20 rounded-lg text-xs font-medium text-gray-900 transition-colors duration-200">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form action="{{ route('dashboard.galeri.destroy', $item) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="w-full inline-flex items-center justify-center px-3 py-2 bg-red-500/90 backdrop-blur-sm hover:bg-red-600 border border-red-400/20 rounded-lg text-xs font-medium text-white transition-colors duration-200">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Content --}}
                                <div class="p-4">
                                    <p class="text-sm text-gray-700 line-clamp-2" title="{{ $item->keterangan }}">
                                        {{ $item->keterangan ?? 'Tanpa keterangan' }}
                                    </p>
                                    <div class="mt-3 flex items-center justify-between text-xs text-gray-500">
                                        <span>{{ $item->created_at->format('d M Y') }}</span>
                                        <span>{{ $item->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>

                            @if($loop->last)
                            </div>
                            @endif
                        </div>

                        @if($loop->last)
                        </div>
                        @endif
                    @empty
                        {{-- Empty State --}}
                        <div class="text-center py-12 px-4">
                            <div class="mx-auto w-20 h-20 lg:w-24 lg:h-24 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-10 h-10 lg:w-12 lg:h-12 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-base lg:text-lg font-semibold text-gray-900 mb-2">
                                @if($search)
                                    Tidak Ada Hasil Pencarian
                                @else
                                    Belum Ada Foto
                                @endif
                            </h3>
                            <p class="text-sm lg:text-base text-gray-600 mb-6 max-w-sm mx-auto">
                                @if($search)
                                    Tidak ditemukan foto yang sesuai dengan pencarian "{{ $search }}". Coba gunakan kata kunci yang berbeda.
                                @else
                                    Galeri masih kosong. Mulai dengan menambahkan foto pertama Anda.
                                @endif
                            </p>
                            @if($search)
                                <a href="{{ route('dashboard.galeri.index') }}"
                                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Hapus Filter
                                </a>
                            @else
                                <a href="{{ route('dashboard.galeri.create') }}"
                                   class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Tambah Foto Pertama
                                </a>
                            @endif
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if($semua_galeri->hasPages())
                <div class="border-t border-gray-200 bg-gray-50/50 px-4 sm:px-6 py-4">
                    <div class="flex flex-col sm:flex-row items-center justify-between space-y-3 sm:space-y-0">
                        <div class="text-sm text-gray-700 order-2 sm:order-1">
                            <span class="hidden sm:inline">Menampilkan {{ $semua_galeri->firstItem() ?? 0 }} - {{ $semua_galeri->lastItem() ?? 0 }} dari {{ $semua_galeri->total() }} foto</span>
                            <span class="sm:hidden">{{ $semua_galeri->firstItem() ?? 0 }}-{{ $semua_galeri->lastItem() ?? 0 }} / {{ $semua_galeri->total() }}</span>
                        </div>
                        <div class="order-1 sm:order-2">
                            {{ $semua_galeri->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
