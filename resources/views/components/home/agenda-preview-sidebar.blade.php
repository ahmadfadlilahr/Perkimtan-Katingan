{{-- resources/views/components/home/agenda-preview-sidebar.blade.php --}}
@php
    // Ambil agenda terbaru yang published (termasuk agenda hari ini)
    $agendaTerbaru = \App\Models\Agenda::where('status', 'published')
        ->where('is_publik', true)
        ->where('tanggal_agenda', '>=', now()->startOfDay()) // Mulai dari awal hari ini
        ->orderBy('tanggal_agenda', 'asc')
        ->take(3)
        ->get();

    // Jika tidak ada agenda masa depan, ambil agenda terbaru yang sudah lewat
    if($agendaTerbaru->count() == 0) {
        $agendaTerbaru = \App\Models\Agenda::where('status', 'published')
            ->where('is_publik', true)
            ->orderBy('tanggal_agenda', 'desc')
            ->take(3)
            ->get();
    }
@endphp

<div class="space-y-4">
    @forelse($agendaTerbaru as $agenda)
        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors duration-200">
            {{-- Tanggal Badge --}}
            <div class="flex items-start space-x-3 mb-3">
                <div class="flex-shrink-0">
                    <div class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-semibold">
                        {{ \Carbon\Carbon::parse($agenda->tanggal_agenda)->format('d M Y') }}
                    </div>
                </div>
            </div>

            {{-- Judul --}}
            <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2 hover:text-indigo-600 transition-colors">
                <a href="{{ route('agenda.show.public', $agenda->slug) }}">
                    {{ $agenda->judul }}
                </a>
            </h4>

            {{-- Lokasi dan Waktu --}}
            <div class="space-y-1 text-sm text-gray-600">
                @if($agenda->lokasi)
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="line-clamp-1">{{ $agenda->lokasi }}</span>
                    </div>
                @endif
                @if($agenda->waktu_mulai)
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>
                            {{ \Carbon\Carbon::parse($agenda->waktu_mulai)->format('H:i') }}
                            @if($agenda->waktu_selesai)
                                - {{ \Carbon\Carbon::parse($agenda->waktu_selesai)->format('H:i') }}
                            @endif
                            WIB
                        </span>
                    </div>
                @endif
            </div>

            {{-- Status Badge jika diperlukan --}}
            @if($agenda->prioritas)
                <div class="mt-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if($agenda->prioritas == 'rendah') bg-gray-100 text-gray-800
                        @elseif($agenda->prioritas == 'sedang') bg-yellow-100 text-yellow-800
                        @elseif($agenda->prioritas == 'tinggi') bg-orange-100 text-orange-800
                        @elseif($agenda->prioritas == 'mendesak') bg-red-100 text-red-800
                        @else bg-blue-100 text-blue-800 @endif">
                        {{ ucfirst($agenda->prioritas) }}
                    </span>
                </div>
            @endif
        </div>
    @empty
        <div class="text-center py-8 text-gray-500">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0v1m6-1v1m-6 0H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V10a2 2 0 00-2-2h-2m-6 0a2 2 0 002 2h2a2 2 0 002-2m-6 0V7" />
            </svg>
            <p class="text-sm">Belum ada agenda terbaru</p>
        </div>
    @endforelse

    {{-- Link ke halaman agenda lengkap --}}
    @if($agendaTerbaru->count() > 0)
        <div class="pt-4 border-t border-gray-200">
            <a href="{{ route('agenda.index.public') }}"
               class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors duration-200">
                Lihat Semua Agenda
                <svg class="ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    @endif
</div>
