<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Kelola Slider Hero
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola gambar slider yang ditampilkan di halaman utama website
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
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">
                                    Daftar Slide
                                </h3>
                                <p class="text-sm text-gray-500">
                                    Kelola semua slide yang akan ditampilkan
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('dashboard.slide.create') }}"
                           class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105 w-full lg:w-auto">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Slide Baru
                        </a>
                    </div>
                </div>

                {{-- Table Content --}}
                <div class="overflow-hidden">
                    @if($semua_slide->count() > 0)
                        {{-- Desktop Table View (Hidden on mobile) --}}
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
                                            Urutan
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    @foreach ($semua_slide as $slide)
                                        <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="relative">
                                                    <img src="{{ asset('storage/slide/' . $slide->gambar) }}"
                                                         alt="{{ $slide->judul }}"
                                                         class="w-20 h-14 object-cover rounded-lg shadow-sm border border-gray-200">
                                                    <div class="absolute inset-0 rounded-lg bg-black/0 hover:bg-black/10 transition-colors duration-200"></div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="max-w-xs">
                                                    <p class="text-sm font-medium text-gray-900 truncate" title="{{ $slide->judul }}">
                                                        {{ $slide->judul ?? '-' }}
                                                    </p>
                                                    <p class="text-xs text-gray-500 mt-1">
                                                        Dibuat {{ $slide->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($slide->status == 'published')
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
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                                    {{ $slide->urutan }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                                <div class="flex items-center justify-end space-x-2">
                                                    <a href="{{ route('dashboard.slide.edit', $slide) }}"
                                                       class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('dashboard.slide.destroy', $slide) }}"
                                                          method="POST"
                                                          class="inline"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus slide ini?');">
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
                            @foreach ($semua_slide as $slide)
                                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                                    {{-- Header with image and basic info --}}
                                    <div class="flex items-start space-x-4 mb-4">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('storage/slide/' . $slide->gambar) }}"
                                                 alt="{{ $slide->judul }}"
                                                 class="w-20 h-14 object-cover rounded-lg shadow-sm border border-gray-200">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-lg font-semibold text-gray-900 truncate">
                                                {{ $slide->judul ?? 'Slide tanpa judul' }}
                                            </h3>
                                            <p class="text-sm text-gray-500 mt-1">
                                                Dibuat {{ $slide->created_at->diffForHumans() }}
                                            </p>
                                            <div class="flex items-center mt-2">
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200 mr-2">
                                                    Urutan: {{ $slide->urutan }}
                                                </span>
                                                @if($slide->status == 'published')
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
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                        <div class="text-xs text-gray-500">
                                            Slide Hero Website
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('dashboard.slide.edit', $slide) }}"
                                               class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('dashboard.slide.destroy', $slide) }}"
                                                  method="POST"
                                                  class="inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus slide ini?');">
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada slide</h3>
                            <p class="mt-2 text-sm text-gray-500 max-w-sm mx-auto">
                                Mulai dengan membuat slide pertama untuk ditampilkan di halaman utama website.
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('dashboard.slide.create') }}"
                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Tambah Slide Pertama
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Pagination --}}
                @if($semua_slide->hasPages())
                    <div class="border-t border-gray-200 bg-gray-50/50 px-4 lg:px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 flex justify-between lg:hidden">
                                @if ($semua_slide->onFirstPage())
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                        Sebelumnya
                                    </span>
                                @else
                                    <a href="{{ $semua_slide->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-blue-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                        Sebelumnya
                                    </a>
                                @endif

                                @if ($semua_slide->hasMorePages())
                                    <a href="{{ $semua_slide->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-blue-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
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
                                        <span class="font-medium">{{ $semua_slide->firstItem() }}</span>
                                        sampai
                                        <span class="font-medium">{{ $semua_slide->lastItem() }}</span>
                                        dari
                                        <span class="font-medium">{{ $semua_slide->total() }}</span>
                                        hasil
                                    </p>
                                </div>

                                <div>
                                    {{ $semua_slide->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
