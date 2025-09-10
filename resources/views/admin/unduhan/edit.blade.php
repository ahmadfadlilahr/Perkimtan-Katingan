<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Edit File Unduhan
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Perbarui informasi file unduhan yang sudah ada
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                Edit File Unduhan
                            </h3>
                            <p class="text-sm text-gray-600">
                                Perbarui informasi file: {{ $unduhan->judul }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Current File Info --}}
                <div class="bg-gray-50/50 border-b border-gray-200 px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-semibold text-gray-900">File Saat Ini</h4>
                            <p class="text-sm text-gray-600 truncate">{{ $unduhan->file }}</p>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="{{ asset('storage/unduhan/' . $unduhan->file) }}"
                               target="_blank"
                               class="inline-flex items-center px-3 py-1.5 border border-cyan-300 rounded-md text-xs font-medium text-cyan-700 bg-white hover:bg-cyan-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition-colors duration-200">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                </svg>
                                Unduh
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Form Content --}}
                <div class="p-6">
                    <form method="POST" action="{{ route('dashboard.unduhan.update', $unduhan) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

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
                                       value="{{ old('judul', $unduhan->judul) }}"
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
                                Berikan judul yang jelas dan deskriptif untuk file
                            </p>
                        </div>

                        {{-- File Upload Field --}}
                        <div class="space-y-2">
                            <label for="file" class="block text-sm font-semibold text-gray-900">
                                Ganti File
                                <span class="text-gray-500 font-normal">(Opsional)</span>
                            </label>
                            <div class="relative">
                                <input type="file"
                                       id="file"
                                       name="file"
                                       accept=".pdf,.doc,.docx,.xls,.xlsx,.zip,.rar"
                                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 file:mr-4 file:py-3 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-medium file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition-colors duration-200">
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
                                    <span>Kosongkan jika tidak ingin mengganti file</span>
                                    <span>•</span>
                                    <span>Format: PDF, DOC, DOCX, XLS, XLSX, ZIP, RAR</span>
                                    <span>•</span>
                                    <span>Maks 10MB</span>
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
                                          placeholder="Berikan deskripsi singkat tentang file ini untuk membantu pengunjung memahami isinya...">{{ old('deskripsi', $unduhan->deskripsi) }}</textarea>
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
                            <div class="flex items-center space-x-4">
                                <div class="text-sm text-gray-500">
                                    <span class="text-red-500">*</span> Wajib diisi
                                </div>
                                <div class="text-xs text-gray-500">
                                    Terakhir diperbarui: {{ $unduhan->updated_at->format('d M Y H:i') }}
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('dashboard.unduhan.index') }}"
                                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition-colors duration-200">
                                    Batal
                                </a>
                                <button type="submit"
                                        class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Perbarui File
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- File Info Card --}}
            <div class="mt-6 bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl border border-cyan-200 p-6">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900 mb-2">
                            Informasi File
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-700">
                            <div>
                                <span class="font-medium">Dibuat:</span>
                                <span class="ml-2">{{ $unduhan->created_at->format('d M Y H:i') }}</span>
                            </div>
                            <div>
                                <span class="font-medium">Diperbarui:</span>
                                <span class="ml-2">{{ $unduhan->updated_at->format('d M Y H:i') }}</span>
                            </div>
                            <div>
                                <span class="font-medium">Waktu relatif:</span>
                                <span class="ml-2">{{ $unduhan->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
