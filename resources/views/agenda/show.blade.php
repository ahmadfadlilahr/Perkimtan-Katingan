@extends('layouts.public')

@section('title', $agenda->judul . ' - Agenda Kegiatan - Dinas Perkim')

@push('styles')
<style>
/* Additional mobile responsiveness styles for agenda detail */
@media (max-width: 640px) {
    .prose {
        font-size: 14px !important;
        line-height: 1.6 !important;
    }

    .prose h1 { font-size: 1.5rem !important; }
    .prose h2 { font-size: 1.25rem !important; }
    .prose h3 { font-size: 1.125rem !important; }
    .prose h4 { font-size: 1rem !important; }

    .prose p { margin-top: 0.75rem !important; margin-bottom: 0.75rem !important; }
    .prose li { margin-top: 0.25rem !important; margin-bottom: 0.25rem !important; }

    .prose img, .prose video {
        width: 100% !important;
        height: auto !important;
        border-radius: 0.5rem !important;
    }

    /* Prevent horizontal scroll */
    .prose * {
        max-width: 100% !important;
        overflow-wrap: break-word !important;
        word-wrap: break-word !important;
        word-break: break-word !important;
    }

    /* Handle long URLs or text */
    .prose a {
        word-break: break-all !important;
        display: inline-block !important;
    }

    /* Fix table responsiveness */
    .prose table {
        display: block !important;
        overflow-x: auto !important;
        white-space: nowrap !important;
        font-size: 12px !important;
    }
}

/* Ensure proper spacing on very small screens */
@media (max-width: 360px) {
    .prose {
        font-size: 13px !important;
    }
}
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-blue-50">
    {{-- Minimalist Header Section --}}
    <div class="bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-6xl mx-auto px-3 sm:px-4 md:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">
            {{-- Navigation Back Button (Mobile Only) --}}
            <div class="mb-4 sm:hidden">
                <a href="{{ route('agenda.index.public') }}"
                   class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="text-sm font-medium">Kembali ke Agenda</span>
                </a>
            </div>

            {{-- Title Section --}}
            <div class="space-y-3 sm:space-y-4">
                <h1 class="text-xl sm:text-2xl lg:text-3xl xl:text-4xl font-light text-gray-900 leading-tight break-words">{{ $agenda->judul }}</h1>

                {{-- Meta Information Row - Responsive Stack --}}
                <div class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-3 sm:gap-4 lg:gap-6 text-xs sm:text-sm text-gray-600">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0v1m6-1v1m-6 0H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V10a2 2 0 00-2-2h-2m-6 0a2 2 0 002 2h2a2 2 0 002-2m-6 0V7" />
                        </svg>
                        <span class="truncate">{{ \Carbon\Carbon::parse($agenda->tanggal_agenda)->format('d F Y') }}</span>
                    </div>

                    @if($agenda->waktu_mulai)
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="truncate">
                                {{ \Carbon\Carbon::parse($agenda->waktu_mulai)->format('H:i') }}
                                @if($agenda->waktu_selesai)
                                    - {{ \Carbon\Carbon::parse($agenda->waktu_selesai)->format('H:i') }}
                                @endif
                                WIB
                            </span>
                        </div>
                    @endif

                    @if($agenda->lokasi)
                        <div class="flex items-center space-x-2 min-w-0">
                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="break-words text-xs sm:text-sm">{{ $agenda->lokasi }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="max-w-6xl mx-auto px-3 sm:px-4 md:px-6 lg:px-8 py-6 sm:py-8 lg:py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            {{-- Content Column --}}
            <div class="lg:col-span-2 space-y-6 lg:space-y-8">
                {{-- Status Badges - Mobile Optimized --}}
                <div class="flex flex-wrap gap-2 sm:gap-3">
                    {{-- Category Badge --}}
                    <span class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-full text-xs sm:text-sm font-medium bg-indigo-50 text-indigo-700 border border-indigo-200">
                        {{ ucfirst($agenda->kategori) }}
                    </span>

                    {{-- Featured Badge --}}
                    @if($agenda->is_featured)
                        <span class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-full text-xs sm:text-sm font-medium bg-amber-50 text-amber-700 border border-amber-200">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span class="hidden sm:inline">Featured</span>
                            <span class="sm:hidden">⭐</span>
                        </span>
                    @endif

                    {{-- Public/Internal Indicator --}}
                    @if($agenda->is_publik)
                        <span class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-full text-xs sm:text-sm font-medium bg-blue-50 text-blue-700 border border-blue-200">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="hidden sm:inline">Agenda Umum</span>
                            <span class="sm:hidden">Umum</span>
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-full text-xs sm:text-sm font-medium bg-orange-50 text-orange-700 border border-orange-200">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <span class="hidden sm:inline">Agenda Dinas</span>
                            <span class="sm:hidden">Dinas</span>
                        </span>
                    @endif

                    {{-- Online/Offline Indicator --}}
                    @if($agenda->lokasi)
                        @if(str_contains(strtolower($agenda->lokasi), 'online') || str_contains(strtolower($agenda->lokasi), 'virtual') || str_contains(strtolower($agenda->lokasi), 'zoom') || str_contains(strtolower($agenda->lokasi), 'meeting'))
                            <span class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-full text-xs sm:text-sm font-medium bg-purple-50 text-purple-700 border border-purple-200">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Online
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-full text-xs sm:text-sm font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Offline
                            </span>
                        @endif
                    @endif
                </div>

                {{-- Featured Image Section - Mobile Optimized --}}
                @if($agenda->gambar)
                    <div class="relative">
                        <div class="aspect-video rounded-lg sm:rounded-xl overflow-hidden shadow-lg bg-gray-100">
                            <img src="{{ asset('storage/' . $agenda->gambar) }}"
                                 alt="{{ $agenda->judul }}"
                                 class="w-full h-full object-cover">
                        </div>
                    </div>
                @endif

                {{-- Description Section - Mobile Optimized --}}
                <div class="bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6 lg:p-8">
                    <div class="prose prose-gray prose-sm sm:prose-base max-w-none">
                        <div class="overflow-hidden break-words">
                            {!! $agenda->konten !!}
                        </div>
                    </div>
                </div>

                {{-- Attachments Section - Mobile Optimized --}}
                @if($agenda->lampiran)
                    <div class="bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6 lg:p-8">
                        <div class="flex items-center space-x-3 mb-4 sm:mb-6">
                            <div class="flex-shrink-0 w-8 h-8 sm:w-10 sm:h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base sm:text-lg font-medium text-gray-900">Lampiran Dokumen</h3>
                                <p class="text-xs sm:text-sm text-gray-500">Klik untuk mengunduh file</p>
                            </div>
                        </div>

                        <div class="space-y-2 sm:space-y-3">
                            @php
                                $files = is_array($agenda->lampiran) ? $agenda->lampiran : [$agenda->lampiran];
                            @endphp
                            @foreach($files as $file)
                                @if($file)
                                    <div class="group relative bg-gray-50 rounded-lg p-3 sm:p-4 hover:bg-gray-100 transition-all duration-200">
                                        <div class="flex items-center justify-between space-x-3">
                                            <div class="flex items-center space-x-3 min-w-0 flex-1">
                                                <div class="flex-shrink-0">
                                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <p class="text-xs sm:text-sm font-medium text-gray-900 truncate">{{ basename($file) }}</p>
                                                    <p class="text-xs text-gray-500">Dokumen</p>
                                                </div>
                                            </div>
                                            <a href="{{ asset('storage/' . $file) }}"
                                               target="_blank"
                                               class="flex-shrink-0 inline-flex items-center px-2.5 sm:px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-indigo-600 bg-indigo-100 hover:bg-indigo-200 transition-colors duration-200">
                                                <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                <span class="hidden sm:inline">Unduh</span>
                                                <span class="sm:hidden">📄</span>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Organizer Section - Mobile Optimized --}}
                @if($agenda->penyelenggara)
                    <div class="bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6 lg:p-8">
                        <div class="flex items-start space-x-3 mb-3 sm:mb-4">
                            <div class="flex-shrink-0 w-8 h-8 sm:w-10 sm:h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-base sm:text-lg font-medium text-gray-900">Penyelenggara</h3>
                                <p class="text-sm sm:text-base text-gray-700 break-words">{{ $agenda->penyelenggara }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-1 space-y-4 sm:space-y-6">
                {{-- Status & Priority Card --}}
                <div class="bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6">
                    <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-3 sm:mb-4">Informasi Agenda</h3>

                    <div class="space-y-4">
                        {{-- Status Badge --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 block mb-2">Status</label>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium
                                @if($agenda->status == 'published') bg-green-50 text-green-700 border border-green-200
                                @elseif($agenda->status == 'selesai')
                                @elseif($agenda->status == 'dibatalkan')
                                @else @endif">
                                @if($agenda->status == 'published')
                                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Aktif
                                @elseif($agenda->status == 'selesai')
                                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Selesai
                                @elseif($agenda->status == 'dibatalkan')
                                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    Dibatalkan
                                @else
                                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    Draft
                                @endif
                            </span>
                        </div>

                        {{-- Priority Badge --}}
                        <div>
                            <label class="text-sm font-medium text-gray-500 block mb-2">Prioritas</label>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium
                                @if($agenda->prioritas == 'rendah') bg-gray-50 text-gray-700 border border-gray-200
                                @elseif($agenda->prioritas == 'sedang')
                                @elseif($agenda->prioritas == 'tinggi')
                                @else @endif">
                                @if($agenda->prioritas == 'rendah')
                                    <div class="w-2 h-2 bg-gray-400 rounded-full mr-2"></div>
                                @elseif($agenda->prioritas == 'sedang')
                                    <div class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></div>
                                @elseif($agenda->prioritas == 'tinggi')
                                    <div class="w-2 h-2 bg-orange-400 rounded-full mr-2"></div>
                                @else
                                    <div class="w-2 h-2 bg-red-400 rounded-full mr-2"></div>
                                @endif
                                {{ ucfirst($agenda->prioritas) }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Schedule Card --}}
                <div class="bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6">
                    <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-3 sm:mb-4">Jadwal Kegiatan</h3>

                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mt-0.5">
                                <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0v1m6-1v1m-6 0H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V10a2 2 0 00-2-2h-2m-6 0a2 2 0 002 2h2a2 2 0 002-2m-6 0V7" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">Tanggal</p>
                                <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($agenda->tanggal_agenda)->format('d F Y') }}</p>
                            </div>
                        </div>

                        @if($agenda->waktu_mulai)
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Waktu</p>
                                    <p class="text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($agenda->waktu_mulai)->format('H:i') }}
                                        @if($agenda->waktu_selesai)
                                            - {{ \Carbon\Carbon::parse($agenda->waktu_selesai)->format('H:i') }}
                                        @endif
                                        WIB
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if($agenda->lokasi)
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Lokasi</p>
                                    <p class="text-sm text-gray-600">{{ $agenda->lokasi }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Meta Information --}}
                <div class="bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6">
                    <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-3 sm:mb-4">Informasi Publikasi</h3>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Dipublikasikan</span>
                            <span class="text-gray-900 font-medium">{{ $agenda->created_at->format('d M Y') }}</span>
                        </div>
                        @if($agenda->creator)
                            <div class="flex justify-between">
                                <span class="text-gray-500">Oleh</span>
                                <span class="text-gray-900 font-medium">{{ $agenda->creator->name }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between">
                            <span class="text-gray-500">Kategori</span>
                            <span class="text-gray-900 font-medium">{{ ucfirst($agenda->kategori) }}</span>
                        </div>
                    </div>
                </div>

                {{-- Navigation - Hidden on mobile (shown in header) --}}
                <div class="hidden sm:block bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6">
                    <a href="{{ route('agenda.index.public') }}"
                       class="w-full inline-flex items-center justify-center px-4 py-2.5 sm:py-3 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-lg hover:bg-gray-100 hover:border-gray-300 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Agenda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
