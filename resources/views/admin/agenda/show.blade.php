<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent">
                    Detail Agenda
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Informasi lengkap agenda "{{ $agenda->judul }}"
                </p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('dashboard.agenda.edit', $agenda) }}"
                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Agenda
                </a>
                <a href="{{ route('dashboard.agenda.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-lg font-medium text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 relative">
                    <div class="bg-gradient-to-r from-emerald-50 to-green-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg shadow-sm" role="alert">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Main Content --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                {{-- Header Section --}}
                <div class="px-6 py-6 border-b border-gray-200 bg-gradient-to-r from-emerald-50 to-green-50">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-3">
                                <h1 class="text-2xl font-bold text-gray-900">{{ $agenda->judul }}</h1>
                                @if($agenda->is_featured)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                        </svg>
                                        Featured
                                    </span>
                                @endif
                            </div>

                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $agenda->tanggal_agenda_formatted }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $agenda->waktu_agenda_formatted }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $agenda->lokasi }}
                                </div>
                            </div>
                        </div>

                        @if($agenda->gambar)
                            <div class="flex-shrink-0 ml-6">
                                <img src="{{ asset('storage/' . $agenda->gambar) }}"
                                     alt="{{ $agenda->judul }}"
                                     class="h-24 w-24 rounded-lg object-cover border border-gray-200 shadow-sm">
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Status & Category Section --}}
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @switch($agenda->status)
                                        @case('draft') bg-gray-100 text-gray-800 @break
                                        @case('published') bg-green-100 text-green-800 @break
                                        @case('selesai') bg-blue-100 text-blue-800 @break
                                        @case('dibatalkan') bg-red-100 text-red-800 @break
                                        @default bg-gray-100 text-gray-800
                                    @endswitch
                                ">
                                    {{ $agenda->status_label }}
                                </span>
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                            <dd class="mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize
                                    @switch($agenda->kategori)
                                        @case('rapat') bg-blue-100 text-blue-800 @break
                                        @case('sosialisasi') bg-purple-100 text-purple-800 @break
                                        @case('workshop') bg-green-100 text-green-800 @break
                                        @case('acara_publik') bg-orange-100 text-orange-800 @break
                                        @default bg-gray-100 text-gray-800
                                    @endswitch
                                ">
                                    {{ $agenda->kategori_label }}
                                </span>
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Prioritas</dt>
                            <dd class="mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @switch($agenda->prioritas)
                                        @case('mendesak') bg-red-500 text-white @break
                                        @case('tinggi') bg-red-100 text-red-800 @break
                                        @case('sedang') bg-yellow-100 text-yellow-800 @break
                                        @case('rendah') bg-green-100 text-green-800 @break
                                        @default bg-gray-100 text-gray-800
                                    @endswitch
                                ">
                                    {{ $agenda->prioritas_label }}
                                </span>
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Visibilitas</dt>
                            <dd class="mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $agenda->is_publik ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    @if($agenda->is_publik)
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Publik
                                    @else
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                        Internal
                                    @endif
                                </span>
                            </dd>
                        </div>
                    </div>
                </div>

                {{-- Content Section --}}
                <div class="px-6 py-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Konten Agenda</h3>
                    <div class="prose max-w-none text-gray-700">
                        <p class="whitespace-pre-wrap">{{ $agenda->konten }}</p>
                    </div>
                </div>

                {{-- Attachments Section --}}
                @if($agenda->lampiran)
                    <div class="px-6 py-6 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Lampiran</h3>
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $agenda->nama_lampiran ?: 'Dokumen Lampiran' }}</p>
                                <p class="text-sm text-gray-500">File lampiran untuk agenda ini</p>
                            </div>
                            <div class="ml-4">
                                <a href="{{ asset('storage/' . $agenda->lampiran) }}"
                                   target="_blank"
                                   class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Metadata Section --}}
                <div class="px-6 py-6 border-t border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Tambahan</h3>
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Dibuat oleh</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if($agenda->creator)
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 bg-gradient-to-br from-emerald-400 to-green-500 rounded-full flex items-center justify-center">
                                            <span class="text-xs font-medium text-white">{{ substr($agenda->creator->name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $agenda->creator->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $agenda->creator->email }}</p>
                                    </div>
                                </div>
                                @else
                                <span class="text-sm text-gray-500">-</span>
                                @endif
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tanggal dibuat</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $agenda->created_at->format('d M Y, H:i') }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Terakhir diperbarui</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $agenda->updated_at->format('d M Y, H:i') }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Slug URL</dt>
                            <dd class="mt-1 text-sm text-gray-900 font-mono bg-white px-2 py-1 rounded border">{{ $agenda->slug }}</dd>
                        </div>
                    </dl>
                </div>

                {{-- Action Buttons --}}
                <div class="px-6 py-4 border-t border-gray-200 bg-white">
                    <div class="flex justify-between items-center">
                        <div class="flex space-x-3">
                            @if($agenda->is_publik)
                                <a href="{{ route('agenda.show.public', $agenda->slug) }}"
                                   target="_blank"
                                   class="inline-flex items-center px-4 py-2 bg-green-100 hover:bg-green-200 border border-green-300 rounded-lg font-medium text-sm text-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                    Lihat di Website
                                </a>
                            @endif

                            <form action="{{ route('dashboard.agenda.destroy', $agenda) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda ini? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-red-100 hover:bg-red-200 border border-red-300 rounded-lg font-medium text-sm text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus Agenda
                                </button>
                            </form>
                        </div>

                        <div class="text-sm text-gray-500">
                            ID: #{{ $agenda->id }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
