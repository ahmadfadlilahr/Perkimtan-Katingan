<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-violet-600 bg-clip-text text-transparent">
                    Tambah Foto Galeri
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Unggah foto baru ke galeri
                </p>
            </div>
            <a href="{{ route('dashboard.galeri.index') }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            {{-- Form Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                {{-- Header --}}
                <div class="border-b border-gray-200 bg-gradient-to-r from-purple-50 to-violet-50 px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-violet-600 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                Tambah Foto Baru
                            </h3>
                            <p class="text-sm text-gray-600">
                                Unggah foto untuk menambahkan ke galeri
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Form Content --}}
                <div class="p-6">
                    <form method="POST" action="{{ route('dashboard.galeri.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        {{-- Image Upload Field --}}
                        <div class="space-y-2">
                            <label for="gambar" class="block text-sm font-semibold text-gray-900">
                                Pilih Foto <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-purple-400 transition-colors duration-200">
                                    <div class="space-y-2 text-center">
                                        <div class="mx-auto w-12 h-12 bg-gradient-to-br from-purple-100 to-violet-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            <label for="gambar" class="relative cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-purple-500">
                                                <span>Pilih file</span>
                                                <input id="gambar"
                                                       name="gambar"
                                                       type="file"
                                                       accept="image/*"
                                                       class="sr-only"
                                                       required
                                                       onchange="previewImage(this)">
                                            </label>
                                            <span class="pl-1">atau drag and drop</span>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, JPEG, WEBP hingga 2MB
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @error('gambar')
                                <p class="text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror

                            {{-- Image Preview --}}
                            <div id="imagePreview" class="hidden mt-4">
                                <div class="relative">
                                    <img id="previewImg" class="max-w-full h-48 object-cover rounded-lg border border-gray-200">
                                    <button type="button"
                                            onclick="removePreview()"
                                            class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-1 transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Caption Field --}}
                        <div class="space-y-2">
                            <label for="keterangan" class="block text-sm font-semibold text-gray-900">
                                Keterangan Foto
                                <span class="text-gray-500 font-normal">(Opsional)</span>
                            </label>
                            <div class="relative">
                                <textarea id="keterangan"
                                          name="keterangan"
                                          rows="4"
                                          class="block w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200 resize-none"
                                          placeholder="Tambahkan keterangan atau deskripsi untuk foto ini...">{{ old('keterangan') }}</textarea>
                            </div>
                            @error('keterangan')
                                <p class="text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="text-xs text-gray-500">
                                Keterangan akan membantu pengunjung memahami foto ini
                            </p>
                        </div>

                        {{-- Submit Section --}}
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                            <div class="text-sm text-gray-500">
                                <span class="text-red-500">*</span> Wajib diisi
                            </div>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('dashboard.galeri.index') }}"
                                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors duration-200">
                                    Batal
                                </a>
                                <button type="submit"
                                        class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-purple-600 to-violet-600 hover:from-purple-700 hover:to-violet-700 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Simpan Foto
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Guidelines Card --}}
            <div class="mt-6 bg-gradient-to-r from-purple-50 to-violet-50 rounded-xl border border-purple-200 p-6">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-violet-600 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900 mb-2">
                            Panduan Upload Foto
                        </h4>
                        <ul class="text-sm text-gray-700 space-y-1">
                            <li>• Format file yang didukung: PNG, JPG, JPEG, WEBP</li>
                            <li>• Ukuran maksimal file: 2MB</li>
                            <li>• Resolusi yang disarankan: minimal 800x600 pixel</li>
                            <li>• Pastikan foto memiliki kualitas yang baik dan tidak buram</li>
                            <li>• Gunakan keterangan yang deskriptif untuk membantu pengunjung</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript for image preview --}}
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function removePreview() {
            document.getElementById('imagePreview').classList.add('hidden');
            document.getElementById('gambar').value = '';
        }

        // Drag and drop functionality
        const dropZone = document.querySelector('.border-dashed');
        const fileInput = document.getElementById('gambar');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropZone.classList.add('border-purple-400', 'bg-purple-50');
        }

        function unhighlight(e) {
            dropZone.classList.remove('border-purple-400', 'bg-purple-50');
        }

        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length > 0) {
                fileInput.files = files;
                previewImage(fileInput);
            }
        }
    </script>
</x-app-layout>
