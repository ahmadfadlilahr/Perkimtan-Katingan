<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Kelola Unduhan
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola file unduhan yang dapat diakses oleh pengunjung website
                </p>
            </div>

        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                <div class="border-b border-gray-200 bg-gray-50/50 px-4 sm:px-6 py-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">
                                    Daftar File Unduhan
                                </h3>
                                <p class="hidden sm:block text-sm text-gray-500">
                                    Kelola file yang dapat diunduh oleh pengunjung
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('dashboard.unduhan.create') }}"
                           class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105 w-full sm:w-auto">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah File Baru
                        </a>
                    </div>
                </div>

                {{-- Search and Filters Section --}}
                <div class="border-b border-gray-200 bg-white px-4 sm:px-6 py-4">
                    <div class="flex flex-col space-y-4">
                        {{-- Search Bar --}}
                        <div class="relative">
                            <form method="GET" action="{{ route('dashboard.unduhan.index') }}" class="flex flex-col sm:flex-row gap-3">
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </div>
                                    <input type="text"
                                           name="search"
                                           value="{{ request('search') }}"
                                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500 text-sm"
                                           placeholder="Cari berdasarkan judul atau deskripsi file...">
                                </div>
                                <button type="submit"
                                        class="inline-flex items-center justify-center px-6 py-2 border border-gray-300 rounded-lg bg-gray-50 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500 transition-colors duration-200 sm:w-auto">
                                    <svg class="w-4 h-4 mr-2 sm:mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    <span class="sm:hidden">Cari File</span>
                                    <span class="hidden sm:inline">Cari</span>
                                </button>
                            </form>
                        </div>

                        {{-- Reset Button and Results Info --}}
                        @if(request('search'))
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                            <a href="{{ route('dashboard.unduhan.index') }}"
                               class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition-colors duration-200 sm:w-auto">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Reset Pencarian
                            </a>
                            <div class="text-sm text-gray-500 text-center sm:text-right">
                                {{ $semua_unduhan->total() }} hasil
                                untuk "<span class="font-medium">{{ request('search') }}</span>"
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                    {{-- Active Filters Display --}}
                    @if(request('search'))
                        <div class="mt-4 flex flex-wrap items-center gap-2">
                            <span class="text-sm text-gray-500">Filter aktif:</span>

                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-cyan-100 text-cyan-800 border border-cyan-200">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                "{{ request('search') }}"
                            </span>
                        </div>
                    @endif
                </div>

                {{-- Table Content --}}
                <div class="overflow-hidden">
                    @if($semua_unduhan->count() > 0)
                        {{-- Desktop Table View (Hidden on mobile) --}}
                        <div class="hidden lg:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50/80">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            File
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Judul
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Deskripsi
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Tanggal
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    @foreach ($semua_unduhan as $unduhan)
                                        <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <div class="h-10 w-10 rounded-lg bg-gradient-to-br from-cyan-500 to-cyan-600 flex items-center justify-center">
                                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-xs text-gray-500 truncate max-w-[100px]" title="{{ $unduhan->file }}">
                                                            {{ $unduhan->file }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="max-w-xs">
                                                    <a href="{{ asset('storage/unduhan/' . $unduhan->file) }}"
                                                       target="_blank"
                                                       class="text-sm font-medium text-cyan-600 hover:text-cyan-900 hover:underline truncate block"
                                                       title="{{ $unduhan->judul }}">
                                                        {{ $unduhan->judul }}
                                                    </a>
                                                    <p class="text-xs text-gray-500 mt-1">
                                                        Klik untuk unduh
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="max-w-sm">
                                                    <p class="text-sm text-gray-900 truncate" title="{{ $unduhan->deskripsi }}">
                                                        {{ $unduhan->deskripsi }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $unduhan->created_at->format('d M Y') }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    {{ $unduhan->created_at->diffForHumans() }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                                <div class="flex items-center justify-end space-x-2">
                                                    <a href="{{ asset('storage/unduhan/' . $unduhan->file) }}"
                                                       target="_blank"
                                                       class="inline-flex items-center px-3 py-1.5 border border-cyan-300 rounded-md text-xs font-medium text-cyan-700 bg-white hover:bg-cyan-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition-colors duration-200">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                                        </svg>
                                                        Unduh
                                                    </a>
                                                    <a href="{{ route('dashboard.unduhan.edit', $unduhan) }}"
                                                       class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition-colors duration-200">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('dashboard.unduhan.destroy', $unduhan) }}"
                                                          method="POST"
                                                          class="inline"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus file ini?');">
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

                        {{-- Mobile Card View (Visible on mobile, hidden on desktop) --}}
                        <div class="lg:hidden space-y-4 p-4">
                            @foreach ($semua_unduhan as $unduhan)
                                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                                    {{-- Header with file icon and title --}}
                                    <div class="flex items-start space-x-4 mb-3">
                                        <div class="flex-shrink-0">
                                            <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-cyan-500 to-cyan-600 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-sm font-semibold text-gray-900 truncate">
                                                {{ $unduhan->judul }}
                                            </h3>
                                            <p class="text-xs text-gray-500 mt-1 truncate" title="{{ $unduhan->file }}">
                                                {{ $unduhan->file }}
                                            </p>
                                            <p class="text-xs text-gray-400 mt-1">
                                                {{ $unduhan->created_at->format('d M Y') }} • {{ $unduhan->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Description --}}
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-700 line-clamp-2">
                                            {{ $unduhan->deskripsi }}
                                        </p>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-3 border-t border-gray-100 space-y-2 sm:space-y-0">
                                        <div class="text-xs text-gray-500">
                                            File Unduhan
                                        </div>
                                        <div class="flex flex-wrap items-center gap-2">
                                            <a href="{{ asset('storage/unduhan/' . $unduhan->file) }}"
                                               target="_blank"
                                               class="inline-flex items-center px-3 py-1.5 border border-cyan-300 rounded-md text-xs font-medium text-cyan-700 bg-white hover:bg-cyan-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition-colors duration-200">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                                </svg>
                                                Unduh
                                            </a>
                                            <a href="{{ route('dashboard.unduhan.edit', $unduhan) }}"
                                               class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition-colors duration-200">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('dashboard.unduhan.destroy', $unduhan) }}"
                                                  method="POST"
                                                  class="inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus file ini?');">
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
                                    </div>
                                </div>
                            @endforeach
                        </div>
                                </tbody>
                            </table>
                        </div>
                    @else
                        {{-- Empty State --}}
                        <div class="text-center py-12">
                            <div class="mx-auto h-24 w-24 text-gray-300">
                                @if(request('search'))
                                    {{-- No search results --}}
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                @else
                                    {{-- No files yet --}}
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                @endif
                            </div>

                            @if(request('search'))
                                {{-- Search Results Empty State --}}
                                <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada hasil ditemukan</h3>
                                <p class="mt-2 text-sm text-gray-500 max-w-sm mx-auto">
                                    Tidak ditemukan file yang cocok dengan pencarian "<span class="font-medium">{{ request('search') }}</span>".
                                </p>
                                <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center">
                                    <a href="{{ route('dashboard.unduhan.index') }}"
                                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Hapus Filter
                                    </a>
                                    <a href="{{ route('dashboard.unduhan.create') }}"
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Tambah File Baru
                                    </a>
                                </div>
                            @else
                                {{-- No Files Yet Empty State --}}
                                <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada file unduhan</h3>
                                <p class="mt-2 text-sm text-gray-500 max-w-sm mx-auto">
                                    Mulai dengan menambahkan file pertama yang dapat diunduh oleh pengunjung website.
                                </p>
                                <div class="mt-6">
                                    <a href="{{ route('dashboard.unduhan.create') }}"
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Tambah File Pertama
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Pagination --}}
                @if($semua_unduhan->hasPages())
                    <div class="border-t border-gray-200 bg-gray-50/50 px-4 sm:px-6 py-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                            {{-- Mobile pagination --}}
                            <div class="flex justify-between sm:hidden">
                                @if ($semua_unduhan->onFirstPage())
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                        Sebelumnya
                                    </span>
                                @else
                                    <a href="{{ $semua_unduhan->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-cyan-300 focus:border-cyan-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                        Sebelumnya
                                    </a>
                                @endif

                                @if ($semua_unduhan->hasMorePages())
                                    <a href="{{ $semua_unduhan->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-cyan-300 focus:border-cyan-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                        Selanjutnya
                                    </a>
                                @else
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                        Selanjutnya
                                    </span>
                                @endif
                            </div>

                            {{-- Desktop pagination --}}
                            <div class="hidden sm:flex sm:items-center sm:justify-between w-full">
                                <div class="text-sm text-gray-700">
                                    Menampilkan {{ $semua_unduhan->firstItem() ?? 0 }} - {{ $semua_unduhan->lastItem() ?? 0 }}
                                    dari {{ $semua_unduhan->total() }} file
                                </div>
                                <div class="flex items-center justify-center lg:justify-end">
                                    {{ $semua_unduhan->links('pagination::tailwind') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
