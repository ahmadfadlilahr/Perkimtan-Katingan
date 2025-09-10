{{-- resources/views/components/home/pejabat-preview-sidebar.blade.php --}}
@if(isset($pejabatUtama) && $pejabatUtama->count() > 0)
    <div class="space-y-4">
        @foreach($pejabatUtama->take(2) as $pejabat)
            <div class="bg-white rounded-lg p-4 border border-gray-100 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center space-x-3">
                    <img class="h-12 w-12 rounded-full object-cover ring-2 ring-gray-200"
                         src="{{ asset('storage/pejabat/' . $pejabat->foto) }}"
                         alt="{{ $pejabat->nama }}">
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-semibold text-gray-900 truncate">{{ $pejabat->nama }}</h4>
                        <p class="text-xs text-indigo-600 font-medium">{{ $pejabat->jabatan }}</p>
                        @if($pejabat->nip)
                            <p class="text-xs text-gray-500">NIP. {{ $pejabat->nip }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($pejabatUtama->count() > 2)
        <div class="mt-4 text-center">
            <a href="{{ route('struktur-organisasi.public') }}"
               class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500">
                Lihat struktur lengkap
                <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    @endif
@else
    <div class="text-center text-gray-500 py-8">
        <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
        </svg>
        <p class="mt-2 text-sm">Data pejabat belum tersedia</p>
    </div>
@endif
