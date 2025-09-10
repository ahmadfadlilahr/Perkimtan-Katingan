<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Kelola Berita
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola artikel berita yang ditampilkan di website
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            {{-- Alert Success --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4" role="alert">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
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

            {{-- Main Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                {{-- Header --}}
                <div class="border-b border-gray-200 bg-gray-50/50 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">
                                    Daftar Berita
                                </h3>
                                <p class="text-sm text-gray-500">
                                    Kelola semua artikel berita yang akan dipublikasi
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('dashboard.berita.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Berita Baru
                        </a>
                    </div>
                </div>

                {{-- Search and Filters Section --}}
                <div class="border-b border-gray-200 bg-white px-6 py-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                        {{-- Search Bar --}}
                        <div class="relative flex-1 max-w-lg">
                            <form method="GET" action="{{ route('dashboard.berita.index') }}" class="flex">
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </div>
                                    <input type="text"
                                           name="search"
                                           value="{{ request('search') }}"
                                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-l-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 text-sm"
                                           placeholder="Cari berdasarkan judul, penulis, atau konten...">
                                </div>
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 border border-l-0 border-gray-300 rounded-r-lg bg-gray-50 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200">
                                    Cari
                                </button>
                            </form>
                        </div>

                        {{-- Filter and Reset --}}
                        <div class="flex items-center space-x-3">
                            {{-- Status Filter --}}
                            <form method="GET" action="{{ route('dashboard.berita.index') }}" class="flex items-center space-x-2">
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <select name="status"
                                        onchange="this.form.submit()"
                                        class="block w-auto text-sm border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                                    <option value="">Semua Status</option>
                                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Dipublikasi</option>
                                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                </select>
                            </form>

                            {{-- Reset Filters --}}
                            @if(request('search') || request('status'))
                                <a href="{{ route('dashboard.berita.index') }}"
                                   class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Reset
                                </a>
                            @endif

                            {{-- Results Info --}}
                            @if(request('search') || request('status'))
                                <div class="text-sm text-gray-500">
                                    {{ $semua_berita->total() }} hasil
                                    @if(request('search'))
                                        untuk "<span class="font-medium">{{ request('search') }}</span>"
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Active Filters Display --}}
                    @if(request('search') || request('status'))
                        <div class="mt-4 flex flex-wrap items-center gap-2">
                            <span class="text-sm text-gray-500">Filter aktif:</span>

                            @if(request('search'))
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    "{{ request('search') }}"
                                </span>
                            @endif

                            @if(request('status'))
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a1.994 1.994 0 01-1.414.586H7a4 4 0 01-4-4V7a4 4 0 014-4z"/>
                                    </svg>
                                    {{ request('status') === 'published' ? 'Dipublikasi' : 'Draft' }}
                                </span>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Table Content --}}
                <div class="overflow-hidden">
                    @if($semua_berita->count() > 0)
                        <!-- Desktop Table View -->
                        <div class="hidden lg:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50/80">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Gambar
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Judul
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Penulis
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    @foreach ($semua_berita as $berita)
                                        <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="relative">
                                                    @if($berita->gambar)
                                                        <img src="{{ asset('storage/berita/' . $berita->gambar) }}"
                                                             alt="{{ $berita->judul }}"
                                                             class="w-20 h-14 object-cover rounded-lg shadow-sm border border-gray-200">
                                                        <div class="absolute inset-0 rounded-lg bg-black/0 hover:bg-black/10 transition-colors duration-200"></div>
                                                    @else
                                                        <div class="w-20 h-14 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center">
                                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="max-w-xs">
                                                    <p class="text-sm font-medium text-gray-900 truncate" title="{{ $berita->judul }}">
                                                        {{ $berita->judul }}
                                                    </p>
                                                    <p class="text-xs text-gray-500 mt-1">
                                                        Dibuat {{ $berita->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($berita->status == 'published')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                        <div class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1.5"></div>
                                                        Dipublikasi
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                                        <div class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-1.5"></div>
                                                        Draft
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-8 w-8">
                                                        <div class="h-8 w-8 rounded-full bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                                                            <span class="text-xs font-medium text-white">
                                                                {{ substr($berita->penulis, 0, 2) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-sm font-medium text-gray-900">{{ $berita->penulis }}</p>
                                                        <p class="text-xs text-gray-500">Penulis</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                                <div class="flex items-center justify-end space-x-2">
                                                    <a href="{{ route('dashboard.berita.edit', $berita) }}"
                                                       class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-colors duration-200">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('dashboard.berita.destroy', $berita) }}"
                                                          method="POST"
                                                          class="inline"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="inline-flex items-center px-3 py-1.5 border border-red-300 rounded-md text-xs font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="lg:hidden divide-y divide-gray-200">
                            @foreach ($semua_berita as $berita)
                                <div class="p-4 hover:bg-gray-50 transition-colors duration-150">
                                    <div class="flex space-x-4">
                                        <!-- Image -->
                                        <div class="flex-shrink-0">
                                            @if($berita->gambar)
                                                <img src="{{ asset('storage/berita/' . $berita->gambar) }}"
                                                     alt="{{ $berita->judul }}"
                                                     class="w-16 h-12 object-cover rounded-lg shadow-sm border border-gray-200">
                                            @else
                                                <div class="w-16 h-12 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Content -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1 pr-2">
                                                    <p class="text-sm font-medium text-gray-900 line-clamp-2">
                                                        {{ $berita->judul }}
                                                    </p>
                                                    <div class="mt-1 flex items-center space-x-2">
                                                        @if($berita->status == 'published')
                                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                <div class="w-1 h-1 bg-green-400 rounded-full mr-1"></div>
                                                                Dipublikasi
                                                            </span>
                                                        @else
                                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                                <div class="w-1 h-1 bg-gray-400 rounded-full mr-1"></div>
                                                                Draft
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="mt-1 flex items-center text-xs text-gray-500">
                                                        <span>{{ $berita->penulis }}</span>
                                                        <span class="mx-1">•</span>
                                                        <span>{{ $berita->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>

                                                <!-- Actions -->
                                                <div class="flex flex-col space-y-1">
                                                    <a href="{{ route('dashboard.berita.edit', $berita) }}"
                                                       class="inline-flex items-center justify-center p-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-colors duration-200">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('dashboard.berita.destroy', $berita) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="inline-flex items-center justify-center p-2 border border-red-300 rounded-lg text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors duration-200">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        {{-- Empty State --}}
                        <div class="text-center py-12">
                            <div class="mx-auto h-24 w-24 text-gray-300">
                                @if(request('search') || request('status'))
                                    {{-- No search results --}}
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                @else
                                    {{-- No news yet --}}
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"/>
                                    </svg>
                                @endif
                            </div>

                            @if(request('search') || request('status'))
                                {{-- Search Results Empty State --}}
                                <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada hasil ditemukan</h3>
                                <p class="mt-2 text-sm text-gray-500 max-w-sm mx-auto">
                                    @if(request('search'))
                                        Tidak ditemukan berita yang cocok dengan pencarian "<span class="font-medium">{{ request('search') }}</span>"
                                        @if(request('status'))
                                            dengan status {{ request('status') === 'published' ? 'dipublikasi' : 'draft' }}.
                                        @else
                                            .
                                        @endif
                                    @else
                                        Tidak ditemukan berita dengan status {{ request('status') === 'published' ? 'dipublikasi' : 'draft' }}.
                                    @endif
                                </p>
                                <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center">
                                    <a href="{{ route('dashboard.berita.index') }}"
                                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Hapus Filter
                                    </a>
                                    <a href="{{ route('dashboard.berita.create') }}"
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Tambah Berita Baru
                                    </a>
                                </div>
                            @else
                                {{-- No News Yet Empty State --}}
                                <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada berita</h3>
                                <p class="mt-2 text-sm text-gray-500 max-w-sm mx-auto">
                                    Mulai dengan membuat artikel berita pertama untuk ditampilkan di website.
                                </p>
                                <div class="mt-6">
                                    <a href="{{ route('dashboard.berita.create') }}"
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Tambah Berita Pertama
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Pagination --}}
                @if($semua_berita->hasPages())
                    <div class="border-t border-gray-200 bg-gray-50/50 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 flex justify-between sm:hidden">
                                @if ($semua_berita->onFirstPage())
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                        Sebelumnya
                                    </span>
                                @else
                                    <a href="{{ $semua_berita->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-emerald-300 focus:border-emerald-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                        Sebelumnya
                                    </a>
                                @endif

                                @if ($semua_berita->hasMorePages())
                                    <a href="{{ $semua_berita->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-emerald-300 focus:border-emerald-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                        Selanjutnya
                                    </a>
                                @else
                                    <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                        Selanjutnya
                                    </span>
                                @endif
                            </div>

                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700 leading-5">
                                        Menampilkan
                                        <span class="font-medium">{{ $semua_berita->firstItem() }}</span>
                                        sampai
                                        <span class="font-medium">{{ $semua_berita->lastItem() }}</span>
                                        dari
                                        <span class="font-medium">{{ $semua_berita->total() }}</span>
                                        hasil
                                    </p>
                                </div>

                                <div>
                                    {{ $semua_berita->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
