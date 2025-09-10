<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-orange-600 to-amber-600 bg-clip-text text-transparent">
                    Detail Pesan
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Detail lengkap pesan dari {{ $pesan->nama_pengirim }}
                </p>
            </div>
            <a href="{{ route('dashboard.pesan.index') }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            {{-- Message Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                {{-- Header --}}
                <div class="border-b border-gray-200 bg-gradient-to-r from-orange-50 to-amber-50 px-6 py-4">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-amber-600 rounded-full flex items-center justify-center">
                                    <span class="text-lg font-bold text-white">
                                        {{ strtoupper(substr($pesan->nama_pengirim, 0, 1)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900 truncate">
                                    {{ $pesan->subjek }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    Dari: <span class="font-medium">{{ $pesan->nama_pengirim }}</span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $pesan->created_at->format('d F Y, H:i:s') }} • {{ $pesan->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>

                        <div class="flex-shrink-0">
                            @if($pesan->status == 'Belum Dibaca')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-yellow-100 to-orange-100 text-orange-800 border border-orange-200">
                                    <div class="w-1.5 h-1.5 bg-orange-400 rounded-full mr-1.5 animate-pulse"></div>
                                    {{ $pesan->status }}
                                </span>
                            @elseif($pesan->status == 'Sedang Proses')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 border border-blue-200">
                                    <div class="w-1.5 h-1.5 bg-blue-400 rounded-full mr-1.5"></div>
                                    {{ $pesan->status }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 border border-gray-200">
                                    <div class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-1.5"></div>
                                    {{ $pesan->status }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-6">
                    {{-- Sender Information --}}
                    <div class="bg-gray-50/50 rounded-lg p-4 mb-6">
                        <h4 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Informasi Pengirim
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</label>
                                <p class="text-sm text-gray-900 mt-1">{{ $pesan->nama_pengirim }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Email</label>
                                <p class="text-sm text-gray-900 mt-1">
                                    <a href="mailto:{{ $pesan->email_pengirim }}" class="text-orange-600 hover:text-orange-700 transition-colors duration-200">
                                        {{ $pesan->email_pengirim }}
                                    </a>
                                </p>
                            </div>
                            @if($pesan->telepon)
                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon/WhatsApp</label>
                                <p class="text-sm text-gray-900 mt-1">
                                    <a href="tel:{{ $pesan->telepon }}" class="text-orange-600 hover:text-orange-700 transition-colors duration-200">
                                        {{ $pesan->telepon }}
                                    </a>
                                </p>
                            </div>
                            @endif
                            @if($pesan->tipe_pesan)
                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori Pesan</label>
                                <p class="text-sm text-gray-900 mt-1">{{ $pesan->tipe_pesan }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Message Content --}}
                    <div class="mb-6">
                        <h4 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            Isi Pesan
                        </h4>
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                            <div class="prose prose-sm max-w-none text-gray-900 whitespace-pre-wrap">{{ $pesan->isi_pesan }}</div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <div class="text-sm text-gray-500">
                            Pesan ini telah dibaca dan statusnya diperbarui otomatis
                        </div>
                        <div class="flex items-center space-x-3">
                            <a href="mailto:{{ $pesan->email_pengirim }}?subject=Re: {{ $pesan->subjek }}"
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-700 hover:to-amber-700 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Balas via Email
                            </a>
                            <form action="{{ route('dashboard.pesan.destroy', $pesan) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus Pesan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Message Info Card --}}
            <div class="mt-6 bg-gradient-to-r from-orange-50 to-amber-50 rounded-xl border border-orange-200 p-6">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-amber-600 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900 mb-2">
                            Informasi Pesan
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm text-gray-700">
                            <div>
                                <span class="font-medium">Diterima:</span>
                                <span class="ml-2">{{ $pesan->created_at->format('d M Y H:i') }}</span>
                            </div>
                            <div>
                                <span class="font-medium">Status:</span>
                                <span class="ml-2">{{ $pesan->status }}</span>
                            </div>
                            <div>
                                <span class="font-medium">Waktu relatif:</span>
                                <span class="ml-2">{{ $pesan->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
