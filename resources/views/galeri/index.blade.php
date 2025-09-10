@extends('layouts.public')

@section('content')
<div class="bg-white py-12 sm:py-16">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Galeri Foto</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">
                Dokumentasi visual kegiatan Dinas Perkim.
            </p>
        </div>

        <div class="mx-auto mt-16 grid max-w-none grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($fotos as $foto)
                <a href="{{ asset('storage/galeri/' . $foto->gambar) }}"
                   class="glightbox block rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300"
                   data-gallery="gallery1"
                   data-title="{{ $foto->keterangan }}"
                   data-description="{{ $foto->keterangan }}">
                    <img src="{{ asset('storage/galeri/' . $foto->gambar) }}"
                         alt="{{ $foto->keterangan }}"
                         class="aspect-[4/3] w-full object-cover">
                </a>
            @empty
                <div class="col-span-full text-center text-gray-500 py-8">
                    <p>Saat ini belum ada foto di galeri.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-16">
            {{ $fotos->links() }}
        </div>
    </div>
</div>
@endsection
