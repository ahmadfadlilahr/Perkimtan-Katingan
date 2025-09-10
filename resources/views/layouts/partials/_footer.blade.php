{{-- resources/views/layouts/partials/_footer.blade.php --}}
<footer class="bg-gray-100 text-black">
    <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
            {{-- Kolom 1: Info Dinas --}}
            <div class="lg:col-span-2">
                <h3 class="text-xl font-bold text-black mb-4">Dinas Perkim</h3>
                <p class="text-black mb-6 max-w-md">
                    Dinas Perumahan, Kawasan Permukiman dan Pertanahan yang melayani masyarakat dengan profesional, transparan, dan bertanggung jawab.
                </p>
                <div class="flex space-x-4">
                    {{-- <a href="#" class="text-black hover:text-indigo-400 transition-colors duration-200">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                        </svg>
                    </a> --}}
                    <a href="https://www.instagram.com/disperkimtankabkatingan/" class="text-black hover:text-indigo-400 transition-colors duration-200">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    {{-- <a href="#" class="text-black hover:text-indigo-400 transition-colors duration-200">
                        <span class="sr-only">X (Twitter)</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a> --}}
                    <a href="https://www.youtube.com/@disperkimtankatingan" class="text-black hover:text-indigo-400 transition-colors duration-200">
                        <span class="sr-only">YouTube</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Kolom 2: Quick Links --}}
            <div>
                <h3 class="text-sm font-semibold text-black tracking-wider uppercase mb-4">Quick Links</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-black hover:text-indigo-400 transition-colors duration-200">Beranda</a></li>
                    <li><a href="{{ route('profil.visi-misi') }}" class="text-black hover:text-indigo-400 transition-colors duration-200">Visi & Misi</a></li>
                    <li><a href="{{ route('struktur-organisasi.public') }}" class="text-black hover:text-indigo-400 transition-colors duration-200">Struktur Organisasi</a></li>
                    <li><a href="{{ route('berita.index.public') }}" class="text-black hover:text-indigo-400 transition-colors duration-200">Berita</a></li>
                    <li><a href="{{ route('agenda.index.public') }}" class="text-black hover:text-indigo-400 transition-colors duration-200">Agenda</a></li>
                    <li><a href="{{ route('galeri.public') }}" class="text-black hover:text-indigo-400 transition-colors duration-200">Galeri</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Kontak Info --}}
            <div>
                <h3 class="text-sm font-semibold text-black tracking-wider uppercase mb-4">Kontak Kami</h3>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-indigo-400 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-black text-sm">Jl. M.T Haryono Komp. Perkantoran Pemda Kab. Katingan, Kasongan, Kalimantan Tengah, Indonesia 74411</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 text-indigo-400 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="text-black text-sm">(0536) 123-4567</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 text-indigo-400 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-black text-sm">kontak@dinasperkim.test</span>
                    </li>
                    <li class="mt-4">
                        <a href="{{ route('kontak.public') }}"
                           class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-colors duration-200">
                            Hubungi Kami
                            <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Divider --}}
        <div class="border-t border-gray-700 mt-12 pt-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="flex space-x-6 md:order-2">
                    <a href="{{ route('unduhan.public') }}" class="text-black hover:text-indigo-400 transition-colors duration-200 text-sm">Unduhan</a>
                    {{-- <a href="/api/documentation" target="_blank" class="text-black hover:text-indigo-400 transition-colors duration-200 text-sm">API Docs</a>
                    <a href="#" class="text-black hover:text-indigo-400 transition-colors duration-200 text-sm">Privacy Policy</a> --}}
                </div>
                <p class="mt-4 text-sm text-black md:mt-0 md:order-1">
                    &copy; {{ date('Y') }} Dinas Perkim. Semua Hak Cipta Dilindungi.
                    <span class="hidden sm:inline">Dibuat dengan ❤️ untuk melayani masyarakat.</span>
                </p>
            </div>
        </div>
    </div>

    {{-- Include Scroll to Top Component --}}
    @include('components.scroll-to-top')
</footer>
