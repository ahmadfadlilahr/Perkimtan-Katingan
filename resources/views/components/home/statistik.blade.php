{{-- resources/views/components/home/statistik.blade.php --}}
<section class="bg-indigo-600 py-16">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Dinas Perkim dalam Angka</h2>
            <p class="mt-2 text-lg leading-8 text-indigo-200">
                Pencapaian dan layanan yang telah kami berikan
            </p>
        </div>

        <div class="mx-auto mt-12 grid max-w-4xl grid-cols-2 gap-8 lg:grid-cols-4">
            {{-- Berita --}}
            <div class="text-center">
                <div class="text-4xl font-bold text-white">{{ $statistik['berita'] ?? 0 }}</div>
                <div class="mt-2 text-sm font-medium text-indigo-200">Berita Published</div>
            </div>

            {{-- Galeri --}}
            <div class="text-center">
                <div class="text-4xl font-bold text-white">{{ $statistik['galeri'] ?? 0 }}</div>
                <div class="mt-2 text-sm font-medium text-indigo-200">Foto Dokumentasi</div>
            </div>

            {{-- Unduhan --}}
            <div class="text-center">
                <div class="text-4xl font-bold text-white">{{ $statistik['unduhan'] ?? 0 }}</div>
                <div class="mt-2 text-sm font-medium text-indigo-200">File Unduhan</div>
            </div>

            {{-- Years of Service --}}
            <div class="text-center">
                <div class="text-4xl font-bold text-white">{{ $statistik['tahun_pelayanan'] ?? date('Y') - 2020 }}</div>
                <div class="mt-2 text-sm font-medium text-indigo-200">Tahun Melayani</div>
            </div>
        </div>

        {{-- Additional Stats Row --}}
        <div class="mx-auto mt-8 grid max-w-2xl grid-cols-2 gap-8">
            {{-- Pejabat --}}
            <div class="text-center">
                <div class="text-3xl font-bold text-white">{{ $statistik['pejabat'] ?? 0 }}</div>
                <div class="mt-2 text-sm font-medium text-indigo-200">Pejabat & Staf</div>
            </div>

            {{-- Agenda --}}
            <div class="text-center">
                <div class="text-3xl font-bold text-white">{{ $statistik['agenda'] ?? 0 }}</div>
                <div class="mt-2 text-sm font-medium text-indigo-200">Agenda Kegiatan</div>
            </div>
        </div>
    </div>
</section>
