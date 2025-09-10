<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Dynamic Title with Page-specific content --}}
        <title>
            @hasSection('title')
                @yield('title') - {{ config('app.name', 'Dinas Perumahan dan Permukiman') }}
            @else
                {{ config('app.name', 'Dinas Perumahan dan Permukiman') }} - Portal Resmi
            @endif
        </title>

        {{-- Meta Description for SEO --}}
        <meta name="description" content="@yield('meta_description', 'Portal resmi Dinas Perumahan, Kawasan Permukiman dan Pertanahan. Informasi berita, agenda, galeri, dan layanan publik.')">

        {{-- Favicon dengan Logo Dinas --}}
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-dinas.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo-dinas.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo-dinas.png') }}">

        {{-- Link ke CSS Splide.js (untuk slider) --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
        {{-- Link ke CSS GLightbox.js (untuk lightbox) --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

        {{-- Custom CSS untuk GLightbox --}}
        <style>
        /* Custom styling untuk GLightbox */
        .glightbox-clean .gclose {
            top: 20px !important;
            right: 20px !important;
            width: 44px !important;
            height: 44px !important;
            background: rgba(0, 0, 0, 0.7) !important;
            border-radius: 50% !important;
            opacity: 1 !important;
            z-index: 999999 !important;
        }

        .glightbox-clean .gclose svg {
            width: 20px !important;
            height: 20px !important;
        }

        .glightbox-clean .gclose:hover {
            background: rgba(0, 0, 0, 0.9) !important;
            transform: scale(1.1);
        }

        .glightbox-clean .gnext,
        .glightbox-clean .gprev {
            background: rgba(0, 0, 0, 0.7) !important;
            border-radius: 50% !important;
            width: 44px !important;
            height: 44px !important;
            opacity: 1 !important;
        }

        .glightbox-clean .gnext:hover,
        .glightbox-clean .gprev:hover {
            background: rgba(0, 0, 0, 0.9) !important;
            transform: scale(1.1);
        }

        .glightbox-clean .gslide-description {
            background: rgba(0, 0, 0, 0.8) !important;
            color: white !important;
            padding: 12px 20px !important;
            border-radius: 6px !important;
            margin: 20px !important;
        }

        /* Styling untuk content dari TinyMCE di halaman public */
        .prose ol {
            list-style-type: decimal !important;
            padding-left: 1.625rem !important;
            margin-top: 1.25rem !important;
            margin-bottom: 1.25rem !important;
        }

        .prose ol li {
            position: relative !important;
            padding-left: 0.375rem !important;
            margin-top: 0.5rem !important;
            margin-bottom: 0.5rem !important;
        }

        .prose ul {
            list-style-type: disc !important;
            padding-left: 1.625rem !important;
            margin-top: 1.25rem !important;
            margin-bottom: 1.25rem !important;
        }

        .prose ul li {
            position: relative !important;
            padding-left: 0.375rem !important;
            margin-top: 0.5rem !important;
            margin-bottom: 0.5rem !important;
        }

        /* Nested lists */
        .prose ol ol,
        .prose ol ul,
        .prose ul ol,
        .prose ul ul {
            margin-top: 0.75rem !important;
            margin-bottom: 0.75rem !important;
        }

        .prose ol ol {
            list-style-type: lower-alpha !important;
        }

        .prose ol ol ol {
            list-style-type: lower-roman !important;
        }

        .prose ul ul {
            list-style-type: circle !important;
        }

        .prose ul ul ul {
            list-style-type: square !important;
        }

        /* Ensure proper spacing and display */
        .prose li {
            display: list-item !important;
        }

        .prose li p {
            margin-top: 0.75rem !important;
            margin-bottom: 0.75rem !important;
        }

        .prose li > p:first-child {
            margin-top: 0 !important;
        }

        .prose li > p:last-child {
            margin-bottom: 0 !important;
        }

        /* Content Protection - Disable text selection untuk konten berita */
        .content-protected {
            -webkit-user-select: none !important;
            -moz-user-select: none !important;
            -ms-user-select: none !important;
            user-select: none !important;
            -webkit-touch-callout: none !important;
            -webkit-tap-highlight-color: transparent !important;
        }

        .content-protected::selection {
            background: transparent !important;
        }

        .content-protected::-moz-selection {
            background: transparent !important;
        }

        /* Disable right click context menu pada konten */
        .content-protected {
            pointer-events: auto !important;
        }

        /* Disable drag untuk images dalam konten */
        .content-protected img {
            -webkit-user-drag: none !important;
            -khtml-user-drag: none !important;
            -moz-user-drag: none !important;
            -o-user-drag: none !important;
            user-drag: none !important;
            pointer-events: none !important;
        }
        </style>

        {{-- Google reCAPTCHA v2 --}}
        @if(config('services.recaptcha.site_key'))
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        @endif

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100 text-gray-800 flex flex-col min-h-screen">

        {{-- Loading Screen Component - Hanya untuk halaman beranda --}}
        @if(request()->routeIs('home'))
            <x-loading-screen />
        @endif

        @include('layouts.partials._header')

        <main class="flex-grow">
            @yield('content')
        </main>

        @include('layouts.partials._footer')

        {{-- Link ke JavaScript Splide.js --}}
        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
        {{-- Link ke JavaScript GLightbox.js --}}
        <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

        {{-- Custom JavaScript untuk GLightbox Configuration --}}
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi GLightbox
            const lightbox = GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true,
                autoplayVideos: false,
                closeOnOutsideClick: true,
                skin: 'clean',
                cssEfects: {
                    fade: { in: 'fadeIn', out: 'fadeOut' }
                }
            });

            // Event listener untuk ESC key (backup)
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    lightbox.close();
                }
            });

            // Content Protection - Disable keyboard shortcuts dan right click
            const protectedContent = document.querySelector('.content-protected');
            if (protectedContent) {
                // Disable right click pada konten protected
                protectedContent.addEventListener('contextmenu', function(e) {
                    e.preventDefault();
                    return false;
                });

                // Disable keyboard shortcuts (Ctrl+C, Ctrl+A, Ctrl+S, Ctrl+P, F12, dll)
                document.addEventListener('keydown', function(e) {
                    // Disable Ctrl+C (copy)
                    if (e.ctrlKey && e.key === 'c') {
                        e.preventDefault();
                        return false;
                    }
                    // Disable Ctrl+A (select all)
                    if (e.ctrlKey && e.key === 'a') {
                        e.preventDefault();
                        return false;
                    }
                    // Disable Ctrl+S (save)
                    if (e.ctrlKey && e.key === 's') {
                        e.preventDefault();
                        return false;
                    }
                    // Disable Ctrl+P (print)
                    if (e.ctrlKey && e.key === 'p') {
                        e.preventDefault();
                        return false;
                    }
                    // Disable F12 (developer tools)
                    if (e.key === 'F12') {
                        e.preventDefault();
                        return false;
                    }
                    // Disable Ctrl+Shift+I (developer tools)
                    if (e.ctrlKey && e.shiftKey && e.key === 'I') {
                        e.preventDefault();
                        return false;
                    }
                    // Disable Ctrl+U (view source)
                    if (e.ctrlKey && e.key === 'u') {
                        e.preventDefault();
                        return false;
                    }
                });

                // Disable drag and drop
                protectedContent.addEventListener('dragstart', function(e) {
                    e.preventDefault();
                    return false;
                });

                // Show alert jika user mencoba select text
                protectedContent.addEventListener('selectstart', function(e) {
                    e.preventDefault();
                    return false;
                });
            }
        });
        </script>

        {{-- Alpine.js untuk interactivity --}}
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>        @stack('scripts')
    </body>
</html>
