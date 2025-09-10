{{-- resources/views/components/home/galeri-preview-sidebar.blade.php --}}
@if(isset($galeriPreview) && $galeriPreview->count() > 0)
    <div class="grid grid-cols-2 gap-3">
        @foreach($galeriPreview->take(4) as $foto)
            <a href="{{ asset('storage/galeri/' . $foto->gambar) }}"
               class="glightbox relative group overflow-hidden rounded-lg shadow-sm hover:shadow-md transition-all duration-300 block aspect-square"
               data-gallery="gallery-sidebar"
               data-title="{{ $foto->keterangan }}"
               data-description="{{ $foto->keterangan }}">
                <img src="{{ asset('storage/galeri/' . $foto->gambar) }}"
                     alt="{{ $foto->keterangan }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-opacity duration-300"></div>
                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </a>
        @endforeach
    </div>

    @if($galeriPreview->count() > 4)
        <div class="mt-4 text-center">
            <a href="{{ route('galeri.public') }}"
               class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500">
                Lihat semua foto ({{ $galeriPreview->count() }})
                <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    @endif
@else
    <div class="text-center text-gray-500 py-8">
        <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <p class="mt-2 text-sm">Belum ada foto</p>
    </div>
@endif
