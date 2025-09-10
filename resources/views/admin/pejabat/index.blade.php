<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Struktur Organisasi
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola data pejabat dan struktur organisasi instansi
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
                <div class="border-b border-gray-200 bg-gray-50/50 px-4 lg:px-6 py-4">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-3 lg:space-y-0">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">
                                    Daftar Pejabat
                                </h3>
                                <p class="text-sm text-gray-500">
                                    Kelola data pejabat berdasarkan urutan hierarki
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('dashboard.pejabat.create') }}"
                           class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105 w-full lg:w-auto">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Pejabat Baru
                        </a>
                    </div>
                </div>

                {{-- Table Content --}}
                <div class="overflow-hidden">
                    @if($semua_pejabat->count() > 0)
                        {{-- Desktop Table View (Hidden on mobile) --}}
                        <div class="hidden lg:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50/80">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Foto
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Nama
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Jabatan
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            NIP
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Urutan
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    @foreach ($semua_pejabat as $pejabat)
                                        <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="relative">
                                                    @if($pejabat->foto)
                                                        <img src="{{ asset('storage/pejabat/' . $pejabat->foto) }}"
                                                             alt="{{ $pejabat->nama }}"
                                                             class="w-16 h-16 object-cover rounded-lg shadow-sm border border-gray-200">
                                                        <div class="absolute inset-0 rounded-lg bg-black/0 hover:bg-black/10 transition-colors duration-200"></div>
                                                    @else
                                                        <div class="w-16 h-16 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center">
                                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="max-w-xs">
                                                    <p class="text-sm font-medium text-gray-900 truncate" title="{{ $pejabat->nama }}">
                                                        {{ $pejabat->nama }}
                                                    </p>
                                                    @if($pejabat->nip)
                                                        <p class="text-xs text-gray-500 mt-1">
                                                            NIP: {{ $pejabat->nip }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="max-w-sm">
                                                    <p class="text-sm text-gray-900 truncate" title="{{ $pejabat->jabatan }}">
                                                        {{ $pejabat->jabatan }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($pejabat->nip)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                        {{ $pejabat->nip }}
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                                        Tidak ada
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-8 w-8">
                                                        <div class="h-8 w-8 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center">
                                                            <span class="text-xs font-bold text-white">
                                                                {{ $pejabat->urutan }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-xs text-gray-500">Urutan</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                                <div class="flex items-center justify-end space-x-2">
                                                    <a href="{{ route('dashboard.pejabat.edit', $pejabat) }}"
                                                       class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('dashboard.pejabat.destroy', $pejabat) }}"
                                                          method="POST"
                                                          class="inline"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pejabat ini?');">
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
                            @foreach ($semua_pejabat as $pejabat)
                                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                                    {{-- Header with photo and basic info --}}
                                    <div class="flex items-start space-x-4 mb-4">
                                        <div class="flex-shrink-0">
                                            @if($pejabat->foto)
                                                <img src="{{ asset('storage/pejabat/' . $pejabat->foto) }}"
                                                     alt="{{ $pejabat->nama }}"
                                                     class="w-16 h-16 object-cover rounded-lg shadow-sm border border-gray-200">
                                            @else
                                                <div class="w-16 h-16 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-lg font-semibold text-gray-900 truncate">
                                                {{ $pejabat->nama }}
                                            </h3>
                                            <p class="text-sm text-gray-600 mt-1">
                                                {{ $pejabat->jabatan }}
                                            </p>
                                            <div class="flex items-center mt-2">
                                                <div class="h-6 w-6 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center mr-2">
                                                    <span class="text-xs font-bold text-white">
                                                        {{ $pejabat->urutan }}
                                                    </span>
                                                </div>
                                                <span class="text-xs text-gray-500">Urutan dalam struktur</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Details --}}
                                    <div class="space-y-3">
                                        {{-- NIP --}}
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm font-medium text-gray-700">NIP:</span>
                                            @if($pejabat->nip)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                    {{ $pejabat->nip }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                                    Tidak ada
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                        <div class="text-xs text-gray-500">
                                            Pejabat #{{ $pejabat->urutan }}
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('dashboard.pejabat.edit', $pejabat) }}"
                                               class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('dashboard.pejabat.destroy', $pejabat) }}"
                                                  method="POST"
                                                  class="inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pejabat ini?');">
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
                    @else
                        {{-- Empty State --}}
                        <div class="text-center py-12">
                            <div class="mx-auto h-24 w-24 text-gray-300">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada pejabat</h3>
                            <p class="mt-2 text-sm text-gray-500 max-w-sm mx-auto">
                                Mulai dengan menambahkan data pejabat untuk menampilkan struktur organisasi.
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('dashboard.pejabat.create') }}"
                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Tambah Pejabat Pertama
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Pagination --}}
                @if($semua_pejabat->hasPages())
                    <div class="border-t border-gray-200 bg-gray-50/50 px-4 lg:px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 flex justify-between lg:hidden">
                                @if ($semua_pejabat->onFirstPage())
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                        Sebelumnya
                                    </span>
                                @else
                                    <a href="{{ $semua_pejabat->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-indigo-300 focus:border-indigo-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                        Sebelumnya
                                    </a>
                                @endif

                                @if ($semua_pejabat->hasMorePages())
                                    <a href="{{ $semua_pejabat->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-indigo-300 focus:border-indigo-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                        Selanjutnya
                                    </a>
                                @else
                                    <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                        Selanjutnya
                                    </span>
                                @endif
                            </div>

                            <div class="hidden lg:flex-1 lg:flex lg:items-center lg:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700 leading-5">
                                        Menampilkan
                                        <span class="font-medium">{{ $semua_pejabat->firstItem() }}</span>
                                        sampai
                                        <span class="font-medium">{{ $semua_pejabat->lastItem() }}</span>
                                        dari
                                        <span class="font-medium">{{ $semua_pejabat->total() }}</span>
                                        pejabat
                                    </p>
                                </div>

                                <div>
                                    {{ $semua_pejabat->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
