@extends('layouts.public')

@section('content')
<div class="bg-white px-6 py-16 lg:px-8">
    <div class="mx-auto max-w-3xl text-base leading-7 text-gray-700">

        {{-- Tombol Kembali --}}
        <p class="text-base font-semibold leading-7 text-indigo-600">
            <a href="{{ route('berita.index.public') }}">&larr; Kembali ke Semua Berita</a>
        </p>

        {{-- Judul Utama --}}
        <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $berita->judul }}</h1>

        {{-- Info Meta: Penulis & Tanggal --}}
        <div class="mt-6 flex items-center space-x-4 text-sm text-gray-500 border-y border-gray-200 py-4">
            <span>Oleh: <strong>{{ $berita->penulis }}</strong></span>
            <span class="text-gray-300">&bull;</span>
            <time datetime="{{ $berita->created_at->toIso8601String() }}">
                Dipublikasikan pada {{ $berita->created_at->translatedFormat('d F Y') }}
            </time>
        </div>

        {{-- Tombol Share --}}
        <div class="mt-6 flex flex-wrap items-center gap-3">
            <span class="text-sm font-medium text-gray-700">Bagikan:</span>

            {{-- Copy URL Button --}}
            <button onclick="copyToClipboard()" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                </svg>
                Salin Link
            </button>

            {{-- WhatsApp Share --}}
            <a href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . request()->fullUrl()) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors duration-200">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.097"/>
                </svg>
                WhatsApp
            </a>

            {{-- Facebook Share --}}
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                Facebook
            </a>

            {{-- X (Twitter) Share --}}
            <a href="https://x.com/intent/tweet?text={{ urlencode($berita->judul) }}&url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-black text-white text-sm font-medium rounded-lg hover:bg-gray-800 transition-colors duration-200">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                </svg>
                X
            </a>
        </div>

        {{-- Gambar Utama --}}
        @if($berita->gambar)
            <figure class="mt-8">
                <img class="aspect-video rounded-xl bg-gray-50 object-cover w-full max-w-2xl mx-auto" src="{{ asset('storage/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}">
            </figure>
        @endif

        {{-- Konten Artikel dengan Styling Otomatis dari 'prose' --}}
        <div class="mt-8 prose prose-lg max-w-none prose-indigo content-protected">
            {!! $berita->isi !!}
        </div>
    </div>
</div>

{{-- Toast Notification untuk Copy Success --}}
<div id="toast-notification" class="fixed top-4 right-4 z-[9999] transform translate-x-full opacity-0 transition-all duration-300 ease-in-out pointer-events-none">
    <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-3 min-w-max">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span class="whitespace-nowrap">Link berhasil disalin ke clipboard!</span>
    </div>
</div>

@push('scripts')
<script>
// Function untuk copy URL ke clipboard
function copyToClipboard() {
    const url = window.location.href;

    // Modern clipboard API
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(url).then(function() {
            showToast();
        }).catch(function(err) {
            // Fallback jika clipboard API gagal
            fallbackCopyTextToClipboard(url);
        });
    } else {
        // Fallback untuk browser lama atau non-HTTPS
        fallbackCopyTextToClipboard(url);
    }
}

// Fallback copy function untuk browser lama
function fallbackCopyTextToClipboard(text) {
    const textArea = document.createElement("textarea");
    textArea.value = text;

    // Avoid scrolling to bottom
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";
    textArea.style.opacity = "0";

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        const successful = document.execCommand('copy');
        if (successful) {
            showToast();
        } else {
            showUrlPrompt(text);
        }
    } catch (err) {
        showUrlPrompt(text);
    }

    document.body.removeChild(textArea);
}

// Function untuk show toast notification
function showToast() {
    const toast = document.getElementById('toast-notification');

    // Reset toast state terlebih dahulu
    toast.classList.add('translate-x-full', 'opacity-0');
    toast.classList.remove('translate-x-0', 'opacity-100');

    // Force reflow
    toast.offsetHeight;

    // Show toast dengan delay kecil
    setTimeout(function() {
        toast.classList.remove('translate-x-full', 'opacity-0');
        toast.classList.add('translate-x-0', 'opacity-100');
    }, 50);

    // Hide toast after 3 seconds
    setTimeout(function() {
        toast.classList.remove('translate-x-0', 'opacity-100');
        toast.classList.add('translate-x-full', 'opacity-0');
    }, 3050);
}

// Function untuk show URL dalam prompt jika copy gagal
function showUrlPrompt(url) {
    alert('Silakan salin link berikut:\n\n' + url);
}

// Prevent copy untuk konten tapi allow untuk share button
document.addEventListener('DOMContentLoaded', function() {
    // Pastikan toast tersembunyi saat halaman dimuat
    const toast = document.getElementById('toast-notification');
    if (toast) {
        toast.classList.add('translate-x-full', 'opacity-0');
        toast.classList.remove('translate-x-0', 'opacity-100');
    }

    // Setup share buttons
    const shareButtons = document.querySelectorAll('[onclick="copyToClipboard()"]');
    shareButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
});
</script>
@endpush
@endsection
