{{-- resources/views/components/home/layanan-unggulan-compact.blade.php --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Layanan 1: Informasi Berita --}}
    <div class="group relative rounded-xl bg-gradient-to-r from-blue-50 to-indigo-50 p-6 border border-blue-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-start space-x-4">
            <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-blue-100 group-hover:bg-blue-200 transition-colors duration-200 flex-shrink-0">
                <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2V7a2 2 0 00-2-2" />
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Informasi & Berita</h3>
                <p class="text-sm text-gray-600 mb-3">
                    Akses informasi terkini dan berita kegiatan Dinas Perkim.
                </p>
                <a href="{{ route('berita.index.public') }}"
                   class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500">
                    Lihat berita terbaru
                    <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Layanan 2: Agenda Kegiatan --}}
    <div class="group relative rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 p-6 border border-green-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-start space-x-4">
            <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-green-100 group-hover:bg-green-200 transition-colors duration-200 flex-shrink-0">
                <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0v1m6-1v1m-6 0H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V10a2 2 0 00-2-2h-2m-6 0a2 2 0 002 2h2a2 2 0 002-2m-6 0V7" />
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Agenda Kegiatan</h3>
                <p class="text-sm text-gray-600 mb-3">
                    Jadwal kegiatan dan acara yang diselenggarakan Dinas Perkim.
                </p>
                <a href="{{ route('agenda.index.public') }}"
                   class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-500">
                    Lihat agenda
                    <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Layanan 3: Galeri Dokumentasi --}}
    <div class="group relative rounded-xl bg-gradient-to-r from-purple-50 to-indigo-50 p-6 border border-purple-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-start space-x-4">
            <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-purple-100 group-hover:bg-purple-200 transition-colors duration-200 flex-shrink-0">
                <svg class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Galeri Dokumentasi</h3>
                <p class="text-sm text-gray-600 mb-3">
                    Dokumentasi foto kegiatan dan program pembangunan.
                </p>
                <a href="{{ route('galeri.public') }}"
                   class="inline-flex items-center text-sm font-medium text-purple-600 hover:text-purple-500">
                    Lihat galeri
                    <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Layanan 4: Pengaduan Masyarakat --}}
    <div class="group relative rounded-xl bg-gradient-to-r from-red-50 to-pink-50 p-6 border border-red-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-start space-x-4">
            <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-red-100 group-hover:bg-red-200 transition-colors duration-200 flex-shrink-0">
                <svg class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Pengaduan Masyarakat</h3>
                <p class="text-sm text-gray-600 mb-3">
                    Saluran aspirasi untuk meningkatkan kualitas pelayanan publik.
                </p>
                <a href="{{ route('kontak.public') }}"
                   class="inline-flex items-center text-sm font-medium text-red-600 hover:text-red-500">
                    Sampaikan pengaduan
                    <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
