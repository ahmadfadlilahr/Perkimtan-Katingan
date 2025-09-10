<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Kotak Masuk
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola pesan dan kontak masuk dari pengunjung
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4">
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

            {{-- Status Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <div class="bg-orange-50 rounded-lg border border-orange-200 p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">Belum Dibaca</div>
                            <div class="text-lg font-bold text-orange-600">
                                {{ $semua_pesan->where('status', 'Belum Dibaca')->count() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-lg border border-blue-200 p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">Sedang Proses</div>
                            <div class="text-lg font-bold text-blue-600">
                                {{ $semua_pesan->where('status', 'Sedang Proses')->count() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg border border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-gray-500 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">Sudah Dibaca</div>
                            <div class="text-lg font-bold text-gray-600">
                                {{ $semua_pesan->where('status', 'Sudah Dibaca')->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Messages Table --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                {{-- Header --}}
                <div class="border-b border-gray-200 bg-gray-50 px-4 sm:px-6 py-4">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-3 sm:space-y-0">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4m16 0l-2-2m2 2l-2 2M4 13l2-2m-2 2l2 2"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">
                                    Daftar Pesan Masuk
                                </h3>
                                <p class="text-sm text-gray-600">
                                    Total {{ $semua_pesan->total() }} {{ Str::plural('pesan', $semua_pesan->total()) }}
                                </p>
                            </div>
                        </div>

                        <div class="text-sm text-gray-500">
                            {{ $semua_pesan->currentPage() }}/{{ $semua_pesan->lastPage() }}
                        </div>
                    </div>
                </div>

                {{-- Table Content --}}
                <div class="overflow-hidden">
                    @if($semua_pesan->count() > 0)
                        {{-- Desktop Table View (Hidden on mobile) --}}
                        <div class="hidden lg:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Pengirim
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Subjek
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($semua_pesan as $pesan)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200 {{ $pesan->status == 'Belum Dibaca' ? 'bg-orange-50/30' : '' }}">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($pesan->status == 'Belum Dibaca')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 border border-orange-200">
                                                        <div class="w-1.5 h-1.5 bg-orange-400 rounded-full mr-1.5 animate-pulse"></div>
                                                        {{ $pesan->status }}
                                                    </span>
                                                @elseif($pesan->status == 'Sedang Proses')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                        <div class="w-1.5 h-1.5 bg-blue-400 rounded-full mr-1.5"></div>
                                                        {{ $pesan->status }}
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
                                                        <div class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-1.5"></div>
                                                        {{ $pesan->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                            <span class="text-xs font-medium text-white">
                                                                {{ strtoupper(substr($pesan->nama_pengirim, 0, 1)) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="text-sm font-medium text-gray-900 {{ $pesan->status == 'Belum Dibaca' ? 'font-bold' : '' }}">
                                                            {{ $pesan->nama_pengirim }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $pesan->email_pengirim }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900 {{ $pesan->status == 'Belum Dibaca' ? 'font-semibold' : '' }}">
                                                    <span class="line-clamp-2 max-w-xs" title="{{ $pesan->subjek }}">
                                                        {{ $pesan->subjek }}
                                                    </span>
                                                </div>
                                                @if($pesan->tipe_pesan)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    {{ $pesan->tipe_pesan }}
                                                </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <div>{{ $pesan->created_at ? $pesan->created_at->format('d M Y') : '-' }}</div>
                                                <div class="text-xs text-gray-400">{{ $pesan->created_at ? $pesan->created_at->format('H:i') : '' }}</div>
                                                <div class="text-xs text-gray-400 mt-1">{{ $pesan->created_at ? $pesan->created_at->diffForHumans() : '' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex items-center space-x-2">
                                                    <a href="{{ route('dashboard.pesan.show', $pesan) }}"
                                                       class="inline-flex items-center px-3 py-1.5 bg-orange-100 hover:bg-orange-200 text-orange-700 text-xs font-medium rounded-lg border border-orange-200 transition-colors duration-200">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                        </svg>
                                                        Lihat
                                                    </a>
                                                    <form action="{{ route('dashboard.pesan.destroy', $pesan) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 text-xs font-medium rounded-lg border border-red-200 transition-colors duration-200">
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
                            @foreach ($semua_pesan as $pesan)
                                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200 {{ $pesan->status == 'Belum Dibaca' ? 'border-orange-200 bg-orange-50/30' : '' }}">
                                    {{-- Header with sender info and status --}}
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center">
                                                    <span class="text-sm font-medium text-white">
                                                        {{ strtoupper(substr($pesan->nama_pengirim, 0, 1)) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-sm font-semibold text-gray-900 {{ $pesan->status == 'Belum Dibaca' ? 'font-bold' : '' }}">
                                                    {{ $pesan->nama_pengirim }}
                                                </h3>
                                                <p class="text-xs text-gray-500 truncate">
                                                    {{ $pesan->email_pengirim }}
                                                </p>
                                            </div>
                                        </div>
                                        @if($pesan->status == 'Belum Dibaca')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800 border border-orange-200">
                                                <div class="w-1.5 h-1.5 bg-orange-400 rounded-full mr-1.5 animate-pulse"></div>
                                                Baru
                                            </span>
                                        @elseif($pesan->status == 'Sedang Proses')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                <div class="w-1.5 h-1.5 bg-blue-400 rounded-full mr-1.5"></div>
                                                Proses
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
                                                <div class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-1.5"></div>
                                                Selesai
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Message subject and type --}}
                                    <div class="space-y-2 mb-3">
                                        <h4 class="text-sm font-medium text-gray-900 {{ $pesan->status == 'Belum Dibaca' ? 'font-semibold' : '' }}">
                                            {{ $pesan->subjek }}
                                        </h4>
                                        @if($pesan->tipe_pesan)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
                                                {{ $pesan->tipe_pesan }}
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Date and actions --}}
                                    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                        <div class="text-xs text-gray-500">
                                            <div>{{ $pesan->created_at ? $pesan->created_at->format('d M Y, H:i') : '-' }}</div>
                                            <div>{{ $pesan->created_at ? $pesan->created_at->diffForHumans() : '' }}</div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('dashboard.pesan.show', $pesan) }}"
                                               class="inline-flex items-center px-3 py-1.5 bg-orange-100 hover:bg-orange-200 text-orange-700 text-xs font-medium rounded-lg border border-orange-200 transition-colors duration-200">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                Lihat
                                            </a>
                                            <form action="{{ route('dashboard.pesan.destroy', $pesan) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 text-xs font-medium rounded-lg border border-red-200 transition-colors duration-200">
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
                        <div class="text-center py-12 px-4">
                            <div class="mx-auto w-20 h-20 lg:w-24 lg:h-24 bg-orange-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-10 h-10 lg:w-12 lg:h-12 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4m16 0l-2-2m2 2l-2 2M4 13l2-2m-2 2l2 2"/>
                                </svg>
                            </div>
                            <h3 class="text-base lg:text-lg font-semibold text-gray-900 mb-2">
                                Belum Ada Pesan
                            </h3>
                            <p class="text-sm lg:text-base text-gray-600 max-w-sm mx-auto">
                                Belum ada pesan masuk dari pengunjung. Pesan akan muncul di sini ketika ada yang menghubungi Anda.
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Pagination --}}
                @if($semua_pesan->hasPages())
                <div class="border-t border-gray-200 bg-gray-50/50 px-4 lg:px-6 py-4">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-3 lg:space-y-0">
                        <div class="text-xs lg:text-sm text-gray-700 text-center lg:text-left">
                            Menampilkan {{ $semua_pesan->firstItem() ?? 0 }} - {{ $semua_pesan->lastItem() ?? 0 }}
                            dari {{ $semua_pesan->total() }} pesan
                        </div>
                        <div class="flex items-center justify-center lg:justify-end">
                            {{ $semua_pesan->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
