{{-- resources/views/components/navigation.blade.php --}}
<nav class="mx-auto max-w-7xl px-6 lg:px-8 py-4">
    <div class="flex justify-between items-center">
        {{-- Logo Section - dengan space yang cukup untuk logo dan teks --}}
        <div class="flex-shrink-0 min-w-fit">
            <a href="{{ route('home') }}" class="block hover:opacity-90 transition-opacity duration-200">
                <x-logo size="default" />
            </a>
        </div>

        {{-- Desktop Navigation - responsif untuk memberikan space yang cukup --}}
        <div class="hidden md:flex items-center space-x-1 flex-grow justify-end">
            <a href="{{ route('home') }}"
               class="px-3 lg:px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all duration-200 {{ request()->routeIs('home') ? 'text-indigo-600 bg-indigo-50' : '' }}">
                Beranda
            </a>

            {{-- Profil Dropdown --}}
            <div class="relative" @click.away="profileDropdownOpen = false">
                <button @click="profileDropdownOpen = !profileDropdownOpen"
                        class="px-3 lg:px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg flex items-center transition-all duration-200 {{ request()->routeIs('profil.*') || request()->routeIs('struktur-organisasi.public') ? 'text-indigo-600 bg-indigo-50' : '' }}">
                    <span>Profil</span>
                    <svg class="w-4 h-4 ml-1 transform transition-transform duration-200"
                         :class="{ 'rotate-180': profileDropdownOpen }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="profileDropdownOpen"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-100 z-30 overflow-hidden"
                     style="display: none;">
                    <div class="py-2">
                        <a href="{{ route('profil.visi-misi') }}"
                           class="block px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium">Visi & Misi</div>
                                    <div class="text-xs text-gray-500">Visi & misi</div>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('struktur-organisasi.public') }}"
                           class="block px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium">Struktur Organisasi</div>
                                    <div class="text-xs text-gray-500">Bagan organisasi dinas</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <a href="{{ route('berita.index.public') }}"
               class="px-3 lg:px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all duration-200 {{ request()->routeIs('berita.*') ? 'text-indigo-600 bg-indigo-50' : '' }}">
                Berita
            </a>
            <a href="{{ route('agenda.index.public') }}"
               class="px-3 lg:px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all duration-200 {{ request()->routeIs('agenda.*') ? 'text-indigo-600 bg-indigo-50' : '' }}">
                Agenda
            </a>
            <a href="{{ route('galeri.public') }}"
               class="px-3 lg:px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all duration-200 {{ request()->routeIs('galeri.*') ? 'text-indigo-600 bg-indigo-50' : '' }}">
                Galeri
            </a>
            <a href="{{ route('unduhan.public') }}"
               class="px-3 lg:px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all duration-200 {{ request()->routeIs('unduhan.*') ? 'text-indigo-600 bg-indigo-50' : '' }}">
                Unduhan
            </a>
            <a href="{{ route('kontak.public') }}"
               class="px-3 lg:px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all duration-200 {{ request()->routeIs('kontak.*') ? 'text-indigo-600 bg-indigo-50' : '' }}">
                Kontak
            </a>
        </div>

        {{-- Tablet & Mobile Menu Button - lebih responsive --}}
        <div class="md:hidden flex items-center">
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="text-gray-600 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 p-2 rounded-lg transition-colors duration-200">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Navigation Menu --}}
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-2"
         class="md:hidden mt-6 pb-4 border-t border-gray-100"
         style="display: none;">
        <div class="space-y-2 pt-4">
            <a href="{{ route('home') }}"
               class="block px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200 {{ request()->routeIs('home') ? 'text-indigo-600 bg-indigo-50' : '' }}"
               @click="mobileMenuOpen = false">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <span class="font-medium">Beranda</span>
                </div>
            </a>

            {{-- Mobile Profil Section --}}
            <div class="space-y-1">
                <div class="px-4 py-2 text-sm font-semibold text-gray-500 uppercase tracking-wide">Profil Dinas</div>
                <a href="{{ route('profil.visi-misi') }}"
                   class="block px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200 ml-4"
                   @click="mobileMenuOpen = false">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                        <span>Visi & Misi</span>
                    </div>
                </a>
                <a href="{{ route('struktur-organisasi.public') }}"
                   class="block px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200 ml-4"
                   @click="mobileMenuOpen = false">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <span>Struktur Organisasi</span>
                    </div>
                </a>
            </div>

            <a href="{{ route('berita.index.public') }}"
               class="block px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200 {{ request()->routeIs('berita.*') ? 'text-indigo-600 bg-indigo-50' : '' }}"
               @click="mobileMenuOpen = false">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"/>
                        </svg>
                    </div>
                    <span class="font-medium">Berita</span>
                </div>
            </a>
            <a href="{{ route('agenda.index.public') }}"
               class="block px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200 {{ request()->routeIs('agenda.*') ? 'text-indigo-600 bg-indigo-50' : '' }}"
               @click="mobileMenuOpen = false">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="font-medium">Agenda</span>
                </div>
            </a>
            <a href="{{ route('galeri.public') }}"
               class="block px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200 {{ request()->routeIs('galeri.*') ? 'text-indigo-600 bg-indigo-50' : '' }}"
               @click="mobileMenuOpen = false">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="font-medium">Galeri</span>
                </div>
            </a>
            <a href="{{ route('unduhan.public') }}"
               class="block px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200 {{ request()->routeIs('unduhan.*') ? 'text-indigo-600 bg-indigo-50' : '' }}"
               @click="mobileMenuOpen = false">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="font-medium">Unduhan</span>
                </div>
            </a>
            <a href="{{ route('kontak.public') }}"
               class="block px-4 py-3 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200 {{ request()->routeIs('kontak.*') ? 'text-indigo-600 bg-indigo-50' : '' }}"
               @click="mobileMenuOpen = false">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="font-medium">Kontak</span>
                </div>
            </a>
        </div>
    </div>
</nav>
