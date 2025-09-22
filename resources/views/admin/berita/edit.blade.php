<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Edit Berita
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Perbarui informasi artikel berita yang sudah ada
                </p>
            </div>
            <a href="{{ route('dashboard.berita.index') }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <form method="POST" action="{{ route('dashboard.berita.update', $berita) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-8">
                    {{-- Basic Information Section --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="border-b border-gray-200 bg-gray-50/50 px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        Informasi Dasar
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        Perbarui judul artikel
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 space-y-6">
                            <div>
                                <x-input-label for="judul" class="text-sm font-medium text-gray-700 mb-2">
                                    Judul Berita *
                                </x-input-label>
                                <x-text-input id="judul"
                                              class="block w-full"
                                              type="text"
                                              name="judul"
                                              :value="old('judul', $berita->judul)"
                                              placeholder="Masukkan judul berita yang menarik..."
                                              required
                                              autofocus />
                                <p class="mt-1 text-xs text-gray-500">Gunakan judul yang deskriptif dan menarik untuk pembaca</p>
                                <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                            </div>


                        </div>
                    </div>

                    {{-- Current Image & Upload Section --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="border-b border-gray-200 bg-gray-50/50 px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        Gambar Artikel
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        Gambar saat ini dan opsi untuk menggantinya
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="space-y-6">
                                {{-- Current Image Preview --}}
                                <div>
                                    <label class="text-sm font-medium text-gray-700 mb-3 block">
                                        Gambar Saat Ini
                                    </label>
                                    @if($berita->gambar)
                                        <div class="relative inline-block">
                                            <img src="{{ asset('storage/berita/' . $berita->gambar) }}"
                                                 alt="{{ $berita->judul }}"
                                                 class="w-full max-w-md h-48 object-cover rounded-lg shadow-sm border border-gray-200">
                                            <div class="absolute top-2 right-2">
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-white/90 text-gray-700 border border-gray-200">
                                                    {{ $berita->gambar }}
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="w-full max-w-md h-48 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center">
                                            <div class="text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <p class="mt-2 text-sm text-gray-500">Tidak ada gambar</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- Upload New Image --}}
                                <div>
                                    <x-input-label for="gambar" class="text-sm font-medium text-gray-700 mb-2">
                                        Ganti Gambar (Opsional)
                                    </x-input-label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors duration-200">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="gambar" class="relative cursor-pointer bg-white rounded-md font-medium text-emerald-600 hover:text-emerald-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-emerald-500">
                                                    <span>Upload gambar baru</span>
                                                    <input id="gambar" name="gambar" type="file" class="sr-only" accept="image/*">
                                                </label>
                                                <p class="pl-1">atau drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                PNG, JPG, WEBP hingga 2MB
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-2 flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                        </svg>
                                        Kosongkan jika tidak ingin mengganti gambar yang sudah ada
                                    </div>
                                    <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Content Section --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="border-b border-gray-200 bg-gray-50/50 px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        Konten Artikel
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        Perbarui isi artikel menggunakan rich text editor
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div>
                                <x-input-label for="isi" class="text-sm font-medium text-gray-700 mb-2">
                                    Isi Berita *
                                </x-input-label>
                                <div class="mt-2">
                                    <x-tinymce-editor-new
                                        id="isi"
                                        name="isi"
                                        :value="old('isi', $berita->isi)"
                                        height="500"
                                        required
                                    />
                                </div>
                                <p class="mt-2 text-xs text-gray-500">
                                    Gunakan editor untuk memformat teks, menambahkan gambar, dan membuat konten yang menarik
                                </p>
                                <x-input-error :messages="$errors->get('isi')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- Publication Settings --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="border-b border-gray-200 bg-gray-50/50 px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        Pengaturan Publikasi
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        Perbarui status publikasi artikel
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div>
                                <x-input-label for="status" class="text-sm font-medium text-gray-700 mb-2">
                                    Status Publikasi *
                                </x-input-label>
                                <select name="status"
                                        id="status"
                                        class="block w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm"
                                        required>
                                    <option value="draft" {{ old('status', $berita->status) == 'draft' ? 'selected' : '' }}>
                                        📝 Draft - Simpan sebagai draft
                                    </option>
                                    <option value="published" {{ old('status', $berita->status) == 'published' ? 'selected' : '' }}>
                                        📢 Published - Publikasikan artikel
                                    </option>
                                </select>
                                <p class="mt-1 text-xs text-gray-500">
                                    Pilih "Draft" untuk menyimpan tanpa publikasi, atau "Published" untuk menampilkan di website
                                </p>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <a href="{{ route('dashboard.berita.index') }}"
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batal
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Update Berita
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
