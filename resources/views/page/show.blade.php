@extends('layouts.public')

@section('content')
<div class="bg-white py-12 sm:py-16">
    <div class="mx-auto max-w-4xl px-6 lg:px-8">
        {{-- Judul Halaman --}}
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-center">{{ $halaman->judul }}</h1>

        {{-- Gambar Utama (jika ada) --}}
        @if($halaman->gambar)
            <figure class="mt-8">
                <img class="aspect-video rounded-xl bg-gray-50 object-cover w-full max-w-3xl mx-auto" src="{{ asset('storage/halaman/' . $halaman->gambar) }}" alt="{{ $halaman->judul }}">
            </figure>
        @endif

        {{-- Konten Halaman --}}
        <div class="mt-8 prose prose-lg max-w-none prose-indigo">
            {!! $halaman->konten !!}
        </div>
    </div>
</div>
@endsection
