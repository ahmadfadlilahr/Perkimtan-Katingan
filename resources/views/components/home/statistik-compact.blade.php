{{-- resources/views/components/home/statistik-compact.blade.php --}}
<div class="grid grid-cols-2 gap-4">
    {{-- Berita --}}
    <div class="text-center bg-white rounded-lg p-4 shadow-sm">
        <div class="text-2xl font-bold text-indigo-600">{{ $statistik['berita'] ?? 0 }}</div>
        <div class="text-xs text-gray-600 mt-1">Berita Published</div>
    </div>

    {{-- Galeri --}}
    <div class="text-center bg-white rounded-lg p-4 shadow-sm">
        <div class="text-2xl font-bold text-green-600">{{ $statistik['galeri'] ?? 0 }}</div>
        <div class="text-xs text-gray-600 mt-1">Foto Dokumentasi</div>
    </div>

    {{-- Unduhan --}}
    <div class="text-center bg-white rounded-lg p-4 shadow-sm">
        <div class="text-2xl font-bold text-purple-600">{{ $statistik['unduhan'] ?? 0 }}</div>
        <div class="text-xs text-gray-600 mt-1">File Unduhan</div>
    </div>

    {{-- Agenda --}}
    <div class="text-center bg-white rounded-lg p-4 shadow-sm">
        <div class="text-2xl font-bold text-orange-600">{{ $statistik['agenda'] ?? 0 }}</div>
        <div class="text-xs text-gray-600 mt-1">Agenda Kegiatan</div>
    </div>
</div>

{{-- Additional Info --}}
<div class="mt-6 text-center bg-white rounded-lg p-4 shadow-sm">
    <div class="text-lg font-semibold text-gray-900">{{ $statistik['tahun_pelayanan'] ?? date('Y') - 2020 }} Tahun</div>
    <div class="text-sm text-gray-600">Melayani Masyarakat</div>
    <div class="mt-2 flex items-center justify-center space-x-2">
        <div class="flex items-center text-xs text-gray-500">
            <svg class="w-4 h-4 mr-1 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ $statistik['pejabat'] ?? 0 }} Pejabat & Staf
        </div>
    </div>
</div>
