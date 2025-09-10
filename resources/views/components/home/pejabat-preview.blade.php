{{-- resources/views/components/home/pejabat-preview.blade.php --}}
<section class="bg-indigo-50 py-16">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Pimpinan Dinas</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">
                Jajaran pimpinan yang memimpin Dinas Perkim
            </p>
        </div>

        @if($pejabatUtama && $pejabatUtama->count() > 0)
            <div class="mx-auto mt-12 grid max-w-5xl grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($pejabatUtama as $pejabat)
                    <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition-shadow duration-300 group">
                        <img class="mx-auto h-32 w-32 rounded-full object-cover ring-4 ring-white group-hover:ring-indigo-100 transition-all duration-300"
                             src="{{ asset('storage/pejabat/' . $pejabat->foto) }}"
                             alt="{{ $pejabat->nama }}">
                        <h3 class="mt-6 text-xl font-bold text-gray-900">{{ $pejabat->nama }}</h3>
                        <p class="mt-2 text-base font-semibold text-indigo-600">{{ $pejabat->jabatan }}</p>
                        @if($pejabat->nip)
                            <p class="mt-1 text-sm text-gray-500">NIP. {{ $pejabat->nip }}</p>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('struktur-organisasi.public') }}"
                   class="inline-flex items-center rounded-md bg-indigo-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors duration-200">
                    Lihat Struktur Lengkap
                    <svg class="ml-2 -mr-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                </a>
            </div>
        @else
            <div class="mt-12 text-center text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
                <p class="mt-2">Data pejabat belum tersedia</p>
            </div>
        @endif
    </div>
</section>
