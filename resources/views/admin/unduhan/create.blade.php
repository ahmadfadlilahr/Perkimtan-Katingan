<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Tambah File Unduhan
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Upload file baru yang dapat diunduh oleh pengunjung website
                </p>
            </div>
            <a href="{{ route('dashboard.unduhan.index') }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition-colors duration-200">
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
                <div class="border-b border-gray-200 bg-gradient-to-r from-cyan-50 to-cyan-100/50 px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                Upload File Baru
                            </h3>
                            <p class="text-sm text-gray-600">
                                Isi form di bawah untuk menambahkan file unduhan
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Form Content --}}
                <div class="p-6">
                    <form method="POST" action="{{ route('dashboard.unduhan.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        {{-- Judul Field --}}
                        <div class="space-y-2">
                            <label for="judul" class="block text-sm font-semibold text-gray-900">
                                Judul File <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 110 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 110-2h4z"/>
                                    </svg>
                                </div>
                                <input type="text"
                                       id="judul"
                                       name="judul"
                                       value="{{ old('judul') }}"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors duration-200"
                                       placeholder="Contoh: Formulir Permohonan IMB 2024"
                                       required autofocus>
                            </div>
                            @error('judul')
                                <p class="text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="text-xs text-gray-500">
                                Berikan judul yang jelas dan deskriptif untuk file yang akan diupload
                            </p>
                        </div>

                        {{-- File Upload Field --}}
                        <div class="space-y-2">
                            <label for="file" class="block text-sm font-semibold text-gray-900">
                                File <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="file"
                                       id="file"
                                       name="file"
                                       accept=".pdf,.doc,.docx,.xls,.xlsx,.zip,.rar"
                                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 file:mr-4 file:py-3 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-medium file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition-colors duration-200"
                                       required>
                            </div>
                            @error('file')
                                <p class="text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                            <div class="text-xs text-gray-500">
                                <div class="flex items-center space-x-4">
                                    <span>Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, ZIP, RAR</span>
                                    <span>•</span>
                                    <span>Maksimal 10MB</span>
                                </div>
                            </div>
                        </div>

                        {{-- Deskripsi Field --}}
                        <div class="space-y-2">
                            <label for="deskripsi" class="block text-sm font-semibold text-gray-900">
                                Deskripsi
                                <span class="text-gray-500 font-normal">(Opsional)</span>
                            </label>
                            <div class="relative">
                                <textarea id="deskripsi"
                                          name="deskripsi"
                                          rows="4"
                                          class="block w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors duration-200 resize-none"
                                          placeholder="Berikan deskripsi singkat tentang file ini untuk membantu pengunjung memahami isinya...">{{ old('deskripsi') }}</textarea>
                            </div>
                            @error('deskripsi')
                                <p class="text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="text-xs text-gray-500">
                                Deskripsi akan membantu pengunjung memahami kegunaan file ini
                            </p>
                        </div>

                        {{-- Submit Section --}}
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                            <div class="text-sm text-gray-500">
                                <span class="text-red-500">*</span> Wajib diisi
                            </div>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('dashboard.unduhan.index') }}"
                                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition-colors duration-200">
                                    Batal
                                </a>
                                <button type="submit"
                                        class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                    </svg>
                                    Upload File
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Guidelines Card --}}
            <div class="mt-6 bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl border border-cyan-200 p-6">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900 mb-2">
                            Panduan Upload File
                        </h4>
                        <ul class="text-sm text-gray-700 space-y-1">
                            <li class="flex items-center">
                                <svg class="w-3 h-3 text-cyan-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Gunakan nama file yang jelas dan mudah dipahami
                            </li>
                            <li class="flex items-center">
                                <svg class="w-3 h-3 text-cyan-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Pastikan file dalam kondisi baik dan tidak corrupt
                            </li>
                            <li class="flex items-center">
                                <svg class="w-3 h-3 text-cyan-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Berikan deskripsi yang membantu pengunjung memahami isi file
                            </li>
                            <li class="flex items-center">
                                <svg class="w-3 h-3 text-cyan-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                File akan tersedia untuk diunduh oleh pengunjung website
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
