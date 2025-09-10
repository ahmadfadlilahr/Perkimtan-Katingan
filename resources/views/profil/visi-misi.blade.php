@extends('layouts.public')

@section('content')
{{-- Hero Section --}}
<x-profil.hero-section
    title="Visi & Misi"
    subtitle="Komitmen kami untuk melayani masyarakat dan membangun masa depan yang lebih baik"
/>

{{-- Dynamic Vision & Mission Content --}}
<x-profil.dynamic-vision-mission
    :visiItems="$visiItems"
    :misiItems="$misiItems"
/>

{{-- Call to Action --}}
<div class="bg-gradient-to-r from-indigo-600 to-blue-600 py-16">
    <div class="mx-auto max-w-4xl px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">
            Mari Bersama Membangun Masa Depan
        </h2>
        <p class="text-xl text-indigo-100 mb-8">
            Bergabunglah dengan kami untuk mewujudkan perumahan dan permukiman yang lebih baik bagi seluruh masyarakat
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('kontak.public') }}"
               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition-colors duration-200">
                Hubungi Kami
                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </a>
            <a href="{{ route('struktur-organisasi.public') }}"
               class="inline-flex items-center px-6 py-3 border border-white text-base font-medium rounded-md text-white bg-transparent hover:bg-white hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition-colors duration-200">
                Lihat Struktur Organisasi
                <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </a>
        </div>
    </div>
</div>
@endsection
