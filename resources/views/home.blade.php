@extends('layouts.public')

@section('content')

    {{-- Hero Section dengan Slider Dinamis --}}
    @if($slides->count() > 0)
    <section id="hero-slider" class="splide" aria-label="Hero Slider">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach ($slides as $slide)
                <li class="splide__slide relative bg-gradient-to-br from-slate-900 via-gray-900 to-black">
                    {{-- Background pattern halus untuk mengisi area kosong --}}
                    <div class="absolute inset-0 opacity-5">
                        <div class="w-full h-full" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.4) 1px, transparent 0); background-size: 40px 40px;"></div>
                    </div>

                    {{-- Gambar dengan object-contain agar tidak terpotong --}}
                    <img src="{{ asset('storage/slide/' . $slide->gambar) }}"
                         alt="{{ $slide->judul }}"
                         class="w-full h-[60vh] sm:h-[80vh] md:h-screen object-contain">

                    {{-- Overlay gelap untuk kontras teks --}}
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                        <div class="text-center text-white p-4 max-w-4xl">
                            @if($slide->judul)
                                <h1 class="text-4xl md:text-6xl font-bold drop-shadow-2xl mb-6">{{ $slide->judul }}</h1>
                            @endif
                            @if($slide->subjudul)
                                <p class="mt-4 text-xl md:text-2xl drop-shadow-lg mb-8">{{ $slide->subjudul }}</p>
                            @endif
                            @if($slide->tombol_teks && $slide->tombol_url)
                                <a href="{{ $slide->tombol_url }}"
                                   class="mt-8 inline-flex items-center rounded-md bg-indigo-600 px-8 py-4 text-lg font-semibold text-white shadow-lg hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transform hover:scale-105 transition-all duration-200">
                                    {{ $slide->tombol_teks }}
                                    <svg class="ml-2 -mr-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
    @endif

    {{-- Main Content dengan Grid System --}}
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 py-16">

            {{-- Grid Container dengan 2 kolom utama --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- Kolom Kiri (Content Utama) - 8 kolom --}}
                <div class="lg:col-span-8 space-y-16">

                    {{-- Layanan Unggulan Section --}}
                    <section>
                        <div class="mb-12">
                            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Layanan Unggulan</h2>
                            <p class="mt-2 text-lg leading-8 text-gray-600">
                                Berbagai layanan dan program utama yang kami sediakan untuk masyarakat
                            </p>
                            <div class="mt-2 h-1 w-20 bg-indigo-600 rounded-full"></div>
                        </div>
                        @include('components.home.layanan-unggulan-compact')
                    </section>

                    {{-- Berita Terbaru Section --}}
                    <section>
                        <div class="mb-12">
                            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Berita Terbaru</h2>
                            <p class="mt-2 text-lg leading-8 text-gray-600">
                                Ikuti perkembangan dan informasi terkini dari Dinas Perkim
                            </p>
                            <div class="mt-2 h-1 w-20 bg-indigo-600 rounded-full"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @forelse ($beritaTerbaru->take(4) as $berita)
                                <article class="group relative bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                                    <div class="aspect-[16/9] overflow-hidden">
                                        <img src="{{ asset('storage/berita/' . $berita['gambar']) }}"
                                             alt="{{ $berita['judul'] }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                    <div class="p-6">
                                        <div class="flex items-center gap-x-2 text-xs text-gray-500 mb-3">
                                            <time datetime="{{ \Carbon\Carbon::parse($berita['created_at'])->toIso8601String() }}"
                                                  class="bg-gray-100 px-2 py-1 rounded-full">
                                                {{ \Carbon\Carbon::parse($berita['created_at'])->translatedFormat('d F Y') }}
                                            </time>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors duration-200 line-clamp-2 mb-3">
                                            <a href="{{ route('berita.show.public', $berita['slug']) }}">
                                                <span class="absolute inset-0"></span>
                                                {{ $berita['judul'] }}
                                            </a>
                                        </h3>
                                        <p class="text-sm text-gray-600 mb-4">
                                            Oleh: {{ $berita['penulis'] }}
                                        </p>
                                        <div class="flex items-center text-indigo-600 text-sm font-medium">
                                            Baca selengkapnya
                                            <svg class="ml-1 h-4 w-4 group-hover:translate-x-1 transition-transform duration-200"
                                                 fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </article>
                            @empty
                                <div class="col-span-2 text-center text-gray-500 py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                    <p class="mt-2">Saat ini belum ada berita untuk ditampilkan.</p>
                                </div>
                            @endforelse
                        </div>

                        @if($beritaTerbaru->count() > 0)
                            <div class="mt-8 text-center">
                                <a href="{{ route('berita.index.public') }}"
                                   class="inline-flex items-center rounded-md bg-indigo-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors duration-200">
                                    Lihat Semua Berita
                                    <svg class="ml-2 -mr-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </section>
                </div>

                {{-- Kolom Kanan (Sidebar) - 4 kolom --}}
                <div class="lg:col-span-4 space-y-12">

                    {{-- Statistik Section --}}
                    <section class="bg-gradient-to-br from-indigo-50 to-blue-50 p-6 rounded-2xl">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Statistik Layanan</h3>
                        @include('components.home.statistik-compact')
                    </section>

                    {{-- Agenda Terbaru Section --}}
                    <section class="bg-white border border-gray-200 p-6 rounded-2xl shadow-sm">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Agenda Terbaru</h3>
                        @include('components.home.agenda-preview-sidebar')
                    </section>

                    {{-- Galeri Preview Section --}}
                    <section class="bg-white border border-gray-200 p-6 rounded-2xl shadow-sm">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Galeri Terbaru</h3>
                        @include('components.home.galeri-preview-sidebar')
                    </section>

                    {{-- Pejabat Preview Section --}}
                    <section class="bg-gradient-to-br from-gray-50 to-slate-50 p-6 rounded-2xl">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Pejabat Dinas</h3>
                        @include('components.home.pejabat-preview-sidebar')
                    </section>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<style>
/* Custom styling untuk hero slider yang responsif */
.splide__slide {
    display: flex !important;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    min-height: 60vh;
}

.splide__slide img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    object-fit: contain;
    object-position: center;
    transition: all 0.3s ease;
}

/* Untuk gambar dengan aspek rasio yang cocok */
.splide__slide img.fit-cover {
    object-fit: cover;
    width: 100%;
    height: 100%;
}

/* Untuk gambar dengan aspek rasio yang tidak cocok */
.splide__slide img.fit-contain {
    object-fit: contain;
    max-width: 100%;
    max-height: 100%;
}

/* Fallback untuk browser yang tidak support object-fit */
@supports not (object-fit: contain) {
    .splide__slide img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        min-width: 100%;
        min-height: 100%;
    }
}

/* Responsif untuk mobile - prioritaskan tampilan penuh */
@media (max-width: 768px) {
    .splide__slide {
        min-height: 50vh;
    }

    .splide__slide img {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
}
</style>

<script>
  // Inisialisasi Splide.js dengan konfigurasi yang lebih baik
  document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('hero-slider')) {
        new Splide('#hero-slider', {
            type       : 'loop',
            autoplay   : true,
            interval   : 6000, // ganti gambar setiap 6 detik
            arrows     : true, // menampilkan panah navigasi
            pagination : true, // menampilkan titik-titik di bawah
            pauseOnHover: true, // pause saat hover
            pauseOnFocus: true, // pause saat fokus
            speed      : 1000, // kecepatan transisi
            easing     : 'cubic-bezier(0.25, 1, 0.5, 1)', // smooth easing
        }).mount();
    }

    // Fungsi untuk menyesuaikan gambar slider
    function adjustSliderImages() {
        const slides = document.querySelectorAll('.splide__slide img');

        slides.forEach(img => {
            img.addEventListener('load', function() {
                const slide = this.closest('.splide__slide');
                const slideRect = slide.getBoundingClientRect();
                const imgAspectRatio = this.naturalWidth / this.naturalHeight;
                const slideAspectRatio = slideRect.width / slideRect.height;

                // Hitung perbedaan aspek rasio
                const aspectDifference = Math.abs(imgAspectRatio - slideAspectRatio);

                // Reset classes
                this.classList.remove('fit-cover', 'fit-contain');

                // Jika perbedaan aspek rasio kecil (< 0.3), gunakan cover
                // Jika besar (>= 0.3), gunakan contain untuk mencegah crop berlebihan
                if (aspectDifference < 0.3 && slideAspectRatio > 1) {
                    // Aspek rasio hampir sama dan landscape, aman menggunakan cover
                    this.classList.add('fit-cover');
                    this.style.objectFit = 'cover';
                    this.style.width = '100%';
                    this.style.height = '100%';
                } else {
                    // Aspek rasio berbeda atau portrait, gunakan contain
                    this.classList.add('fit-contain');
                    this.style.objectFit = 'contain';
                    this.style.width = '100%';
                    this.style.height = '100%';
                }

                // Log untuk debugging (bisa dihapus di production)
                console.log(`Image: ${this.src.split('/').pop()}, Img Ratio: ${imgAspectRatio.toFixed(2)}, Slide Ratio: ${slideAspectRatio.toFixed(2)}, Difference: ${aspectDifference.toFixed(2)}, Mode: ${this.style.objectFit}`);
            });

            // Trigger load event jika gambar sudah ter-cache
            if (img.complete) {
                img.dispatchEvent(new Event('load'));
            }
        });
    }

    // Jalankan fungsi saat halaman dimuat dan splide ready
    setTimeout(adjustSliderImages, 100);

    // Jalankan ulang saat window di-resize
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(adjustSliderImages, 250);
    });

    // Smooth scrolling untuk anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
  });
</script>
@endpush
