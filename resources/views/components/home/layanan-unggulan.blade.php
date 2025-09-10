{{-- resources/views/components/home/layanan-unggulan.blade.php --}}
<section class="bg-white py-16">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Layanan Unggulan</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">
                Berbagai layanan dan program utama yang kami sediakan untuk masyarakat
            </p>
        </div>

        <div class="mx-auto mt-12 grid max-w-6xl grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            {{-- Layanan 1: Permohonan IMB --}}
            <div class="group relative rounded-2xl bg-gradient-to-r from-blue-50 to-indigo-50 p-8 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-blue-100 group-hover:bg-blue-200 transition-colors duration-200">
                    <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h3 class="mt-6 text-xl font-semibold text-gray-900">Izin Mendirikan Bangunan</h3>
                <p class="mt-2 text-base text-gray-600">
                    Pelayanan permohonan IMB untuk berbagai jenis bangunan dengan prosedur yang mudah dan transparan.
                </p>
                <div class="mt-6">
                    <a href="{{ route('kontak.public') }}"
                       class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-500">
                        Hubungi kami
                        <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Layanan 2: Perencanaan Tata Ruang --}}
            <div class="group relative rounded-2xl bg-gradient-to-r from-green-50 to-emerald-50 p-8 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-green-100 group-hover:bg-green-200 transition-colors duration-200">
                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                </div>
                <h3 class="mt-6 text-xl font-semibold text-gray-900">Perencanaan Tata Ruang</h3>
                <p class="mt-2 text-base text-gray-600">
                    Konsultasi dan perencanaan tata ruang kota yang berkelanjutan untuk kemajuan daerah.
                </p>
                <div class="mt-6">
                    <a href="{{ route('kontak.public') }}"
                       class="inline-flex items-center text-sm font-semibold text-green-600 hover:text-green-500">
                        Hubungi kami
                        <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Layanan 3: Infrastruktur & Pemukiman --}}
            <div class="group relative rounded-2xl bg-gradient-to-r from-purple-50 to-indigo-50 p-8 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-purple-100 group-hover:bg-purple-200 transition-colors duration-200">
                    <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v0" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21l4-4 4 4M8 3l4 4 4-4" />
                    </svg>
                </div>
                <h3 class="mt-6 text-xl font-semibold text-gray-900">Infrastruktur & Pemukiman</h3>
                <p class="mt-2 text-base text-gray-600">
                    Program pembangunan infrastruktur dan penataan pemukiman untuk kesejahteraan masyarakat.
                </p>
                <div class="mt-6">
                    <a href="{{ route('kontak.public') }}"
                       class="inline-flex items-center text-sm font-semibold text-purple-600 hover:text-purple-500">
                        Hubungi kami
                        <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Layanan 4: Konsultasi Pembangunan --}}
            <div class="group relative rounded-2xl bg-gradient-to-r from-yellow-50 to-orange-50 p-8 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-yellow-100 group-hover:bg-yellow-200 transition-colors duration-200">
                    <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="mt-6 text-xl font-semibold text-gray-900">Konsultasi Pembangunan</h3>
                <p class="mt-2 text-base text-gray-600">
                    Layanan konsultasi teknis untuk proyek pembangunan dan perencanaan kota yang tepat sasaran.
                </p>
                <div class="mt-6">
                    <a href="{{ route('kontak.public') }}"
                       class="inline-flex items-center text-sm font-semibold text-yellow-600 hover:text-yellow-500">
                        Hubungi kami
                        <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Layanan 5: Pengaduan Masyarakat --}}
            <div class="group relative rounded-2xl bg-gradient-to-r from-red-50 to-pink-50 p-8 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-red-100 group-hover:bg-red-200 transition-colors duration-200">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                    </svg>
                </div>
                <h3 class="mt-6 text-xl font-semibold text-gray-900">Pengaduan Masyarakat</h3>
                <p class="mt-2 text-base text-gray-600">
                    Saluran aspirasi dan pengaduan masyarakat untuk meningkatkan kualitas pelayanan publik.
                </p>
                <div class="mt-6">
                    <a href="{{ route('kontak.public') }}"
                       class="inline-flex items-center text-sm font-semibold text-red-600 hover:text-red-500">
                        Sampaikan pengaduan
                        <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Layanan 6: Download Dokumen --}}
            <div class="group relative rounded-2xl bg-gradient-to-r from-gray-50 to-slate-50 p-8 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-gray-100 group-hover:bg-gray-200 transition-colors duration-200">
                    <svg class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="mt-6 text-xl font-semibold text-gray-900">Pusat Unduhan</h3>
                <p class="mt-2 text-base text-gray-600">
                    Formulir, regulasi, dan dokumen publik yang dapat diunduh dengan mudah dan gratis.
                </p>
                <div class="mt-6">
                    <a href="{{ route('unduhan.public') }}"
                       class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-gray-500">
                        Lihat dokumen
                        <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
