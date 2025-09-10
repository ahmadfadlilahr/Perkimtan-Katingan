{{-- resources/views/components/home/galeri-preview.blade.php --}}
<section class="bg-gray-50 py-16">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Galeri Foto</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">
                Dokumentasi visual kegiatan dan prestasi Dinas Perkim
            </p>
        </div>

        @if($galeriPreview && $galeriPreview->count() > 0)
            <div class="mx-auto mt-12 grid max-w-none grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                @foreach($galeriPreview as $foto)
                    <a href="{{ asset('storage/galeri/' . $foto->gambar) }}"
                       class="glightbox relative group overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 block"
                       data-gallery="gallery-preview"
                       data-title="{{ $foto->keterangan }}"
                       data-description="{{ $foto->keterangan }}">
                        <img src="{{ asset('storage/galeri/' . $foto->gambar) }}"
                             alt="{{ $foto->keterangan }}"
                             class="aspect-square w-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-opacity duration-300"></div>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('galeri.public') }}"
                   class="inline-flex items-center rounded-md bg-indigo-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors duration-200">
                    Lihat Semua Foto
                    <svg class="ml-2 -mr-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        @else
            <div class="mt-12 text-center text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="mt-2">Belum ada foto di galeri</p>
            </div>
        @endif
    </div>
</section>
