<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold leading-tight text-gray-900">
                    Agenda
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola agenda kegiatan dan acara
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 lg:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-4 sm:mb-6 rounded-lg bg-green-50 p-4 border border-green-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Search & Filter Section -->
            <div class="mb-6 lg:mb-8">
                <form method="GET" action="{{ route('dashboard.agenda.index') }}" class="space-y-4">
                    <div class="flex flex-col lg:flex-row lg:items-end gap-3 lg:gap-4">
                        <!-- Search Input -->
                        <div class="flex-1">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                Cari Agenda
                            </label>
                            <div class="relative">
                                <input type="text"
                                       name="search"
                                       id="search"
                                       value="{{ request('search') }}"
                                       placeholder="Masukkan judul atau lokasi agenda..."
                                       class="block w-full pr-10 border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Status Filter -->
                        <div class="min-w-0 lg:w-48">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                Status
                            </label>
                            <div class="relative">
                                <select name="status"
                                        id="status"
                                        class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 text-sm appearance-none pr-10">
                                    <option value="">Semua Status</option>
                                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div class="min-w-0 lg:w-48">
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">
                                Kategori
                            </label>
                            <div class="relative">
                                <select name="kategori"
                                        id="kategori"
                                        class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 text-sm appearance-none pr-10">
                                    <option value="">Semua Kategori</option>
                                    <option value="rapat" {{ request('kategori') == 'rapat' ? 'selected' : '' }}>Rapat</option>
                                    <option value="acara" {{ request('kategori') == 'acara' ? 'selected' : '' }}>Acara</option>
                                    <option value="kunjungan" {{ request('kategori') == 'kunjungan' ? 'selected' : '' }}>Kunjungan</option>
                                    <option value="lainnya" {{ request('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="flex gap-2">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <span class="hidden sm:inline">Cari</span>
                            </button>

                            @if(request()->hasAny(['search', 'status', 'kategori']))
                                <a href="{{ route('dashboard.agenda.index') }}"
                                   class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-lg font-medium text-sm text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    <span class="hidden sm:inline">Reset</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </form>

                <!-- Add Button -->
                <div class="mt-4">
                    <a href="{{ route('dashboard.agenda.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        <span class="hidden sm:inline">Tambah Agenda Baru</span>
                        <span class="sm:hidden">Tambah</span>
                    </a>
                </div>
            </div>

            {{-- Agenda Content --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                {{-- Desktop Table View --}}
                <div class="hidden lg:block overflow-x-auto">
                    @forelse ($agendas as $agenda)
                        @if($loop->first)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-emerald-50 to-green-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-emerald-800 uppercase tracking-wider">
                                        Agenda
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-emerald-800 uppercase tracking-wider">
                                        Tanggal & Waktu
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-emerald-800 uppercase tracking-wider">
                                        Kategori
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-emerald-800 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-emerald-800 uppercase tracking-wider">
                                        Prioritas
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-emerald-800 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                        @endif
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-16 w-20 mr-4">
                                                @if($agenda->gambar)
                                                    <img src="{{ asset('storage/' . $agenda->gambar) }}"
                                                         alt="{{ $agenda->judul }}"
                                                         class="h-16 w-20 object-cover rounded-lg border border-gray-200">
                                                @else
                                                    <div class="h-16 w-20 bg-gradient-to-br from-emerald-100 to-green-100 rounded-lg border border-gray-200 flex items-center justify-center">
                                                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 line-clamp-2">
                                                    {{ $agenda->judul }}
                                                </p>
                                                <p class="text-sm text-gray-500 line-clamp-1">
                                                    {{ Str::limit($agenda->lokasi, 30) }}
                                                </p>
                                                @if(!$agenda->is_publik)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 mt-1">
                                                        🔒 Internal
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $agenda->tanggal_agenda_formatted }}</div>
                                        <div class="text-sm text-gray-500">{{ $agenda->waktu_agenda_formatted }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <x-badge type="kategori" :value="$agenda->kategori">
                                            {{ $agenda->kategori_label }}
                                        </x-badge>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <x-badge type="status" :value="$agenda->status">
                                            {{ $agenda->status_label }}
                                        </x-badge>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($agenda->is_featured)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                ⭐ Unggulan
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-sm">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center space-x-3">
                                            <a href="{{ route('dashboard.agenda.show', $agenda) }}"
                                               class="text-emerald-600 hover:text-emerald-900 transition-colors duration-200"
                                               title="Lihat Detail">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('dashboard.agenda.edit', $agenda) }}"
                                               class="text-blue-600 hover:text-blue-900 transition-colors duration-200"
                                               title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('dashboard.agenda.destroy', $agenda) }}"
                                                  method="POST"
                                                  class="inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                                        title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                        @if($loop->last)
                            </tbody>
                        </table>
                        @endif
                    @empty
                        {{-- Empty State for Desktop --}}
                        <div class="text-center py-12 px-4">
                            <div class="mx-auto h-24 w-24 text-gray-300 mb-4">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada agenda</h3>
                            <p class="text-sm text-gray-500 mb-6 max-w-sm mx-auto">Mulai dengan membuat agenda pertama untuk sistem Anda.</p>
                            <a href="{{ route('dashboard.agenda.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Tambah Agenda
                            </a>
                        </div>
                    @endforelse
                </div>

                {{-- Mobile Card View --}}
                <div class="lg:hidden divide-y divide-gray-200">
                    @forelse ($agendas as $agenda)
                        <div class="p-3 hover:bg-gray-50 transition-colors duration-150">
                            <!-- Main Content -->
                            <div class="flex items-start space-x-3">
                                <!-- Image/Icon -->
                                <div class="flex-shrink-0">
                                    @if($agenda->gambar)
                                        <img src="{{ asset('storage/' . $agenda->gambar) }}"
                                             alt="{{ $agenda->judul }}"
                                             class="w-12 h-9 object-cover rounded border border-gray-200">
                                    @else
                                        <div class="w-12 h-9 bg-gradient-to-br from-emerald-100 to-green-100 rounded border border-gray-200 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-medium text-gray-900 line-clamp-2 leading-tight">
                                        {{ $agenda->judul }}
                                    </h3>

                                    <p class="text-xs text-gray-500 mt-1">{{ Str::limit($agenda->lokasi, 25) }}</p>

                                    <!-- Date & Time -->
                                    <div class="mt-2 text-xs text-gray-500 space-y-0.5">
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $agenda->tanggal_agenda_formatted }}
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $agenda->waktu_agenda_formatted }}
                                        </div>
                                    </div>

                                    <!-- Badges -->
                                    <div class="mt-2 flex flex-wrap items-center gap-1">
                                        <x-badge type="status" :value="$agenda->status" class="text-xs px-1.5 py-0.5">
                                            {{ $agenda->status_label }}
                                        </x-badge>
                                        <x-badge type="kategori" :value="$agenda->kategori" class="text-xs px-1.5 py-0.5">
                                            {{ $agenda->kategori_label }}
                                        </x-badge>
                                        @if($agenda->is_featured)
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                ⭐
                                            </span>
                                        @endif
                                        @if(!$agenda->is_publik)
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                                🔒
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Actions Row -->
                            <div class="mt-3 flex items-center justify-end space-x-2">
                                <a href="{{ route('dashboard.agenda.show', $agenda) }}"
                                   class="inline-flex items-center px-2 py-1 text-xs font-medium text-emerald-700 bg-emerald-50 border border-emerald-200 rounded hover:bg-emerald-100 transition-colors duration-200"
                                   title="Lihat Detail">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat
                                </a>
                                <a href="{{ route('dashboard.agenda.edit', $agenda) }}"
                                   class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-50 border border-blue-200 rounded hover:bg-blue-100 transition-colors duration-200"
                                   title="Edit">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('dashboard.agenda.destroy', $agenda) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-700 bg-red-50 border border-red-200 rounded hover:bg-red-100 transition-colors duration-200"
                                            title="Hapus">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        {{-- Empty State for Mobile --}}
                        <div class="text-center py-12 px-4">
                            <div class="mx-auto h-24 w-24 text-gray-300 mb-4">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada agenda</h3>
                            <p class="text-sm text-gray-500 mb-6 max-w-sm mx-auto">Mulai dengan membuat agenda pertama untuk sistem Anda.</p>
                            <a href="{{ route('dashboard.agenda.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Tambah Agenda
                            </a>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if($agendas->hasPages())
                    <div class="px-3 sm:px-4 lg:px-6 py-3 sm:py-4 border-t border-gray-200">
                        {{ $agendas->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<style>
/* Custom dropdown arrow styling to prevent overlap */
select {
    background-image: none !important;
}

.line-clamp-1 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
}

.line-clamp-2 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}
</style>
