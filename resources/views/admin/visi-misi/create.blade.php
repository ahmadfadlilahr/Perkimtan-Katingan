<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent">
                    Tambah {{ $types[$type] ?? ucfirst($type) }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Buat {{ strtolower($types[$type] ?? $type) }} baru untuk organisasi
                </p>
            </div>
            <a href="{{ route('dashboard.visi-misi.index', ['type' => $type]) }}"
               class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-lg font-medium text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">

    <!-- Main Form Card -->
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-50 to-green-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @if($type === 'visi')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        @endif
                    </svg>
                    Form Tambah {{ $types[$type] ?? ucfirst($type) }}
                </h3>
            </div>

            <!-- Form -->
            <form action="{{ route('dashboard.visi-misi.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <!-- Type (hidden) -->
                <input type="hidden" name="type" value="{{ $type }}">

                <!-- Type Display -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe</label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3">
                        <span class="text-lg font-semibold text-emerald-700">{{ $types[$type] ?? ucfirst($type) }}</span>
                    </div>
                </div>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 {{ $errors->has('title') ? 'border-red-500' : 'border-gray-300' }}"
                           placeholder="Masukkan judul {{ strtolower($types[$type] ?? $type) }}">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        Konten <span class="text-red-500">*</span>
                    </label>
                    <textarea id="content" name="content" rows="6" required
                              class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 resize-vertical break-words whitespace-pre-wrap {{ $errors->has('content') ? 'border-red-500' : 'border-gray-300' }}"
                              style="word-wrap: break-word; word-break: break-word; overflow-wrap: break-word; white-space: pre-wrap;"
                              placeholder="Masukkan konten {{ strtolower($types[$type] ?? $type) }}">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Order Position (for misi only) -->
                @if($type === 'misi')
                <div>
                    <label for="order_position" class="block text-sm font-medium text-gray-700 mb-2">
                        Nomor Urut
                    </label>
                    <input type="number" id="order_position" name="order_position" value="{{ old('order_position', 1) }}" min="1"
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 {{ $errors->has('order_position') ? 'border-red-500' : 'border-gray-300' }}"
                           placeholder="Masukkan nomor urut">
                    @error('order_position')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Nomor urut untuk menentukan posisi misi</p>
                </div>
                @endif

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <div class="relative">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                   class="sr-only peer">
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-700">Aktif</span>
                        </label>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Item aktif akan ditampilkan di halaman public</p>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('dashboard.visi-misi.index', ['type' => $type]) }}"
                       class="px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-emerald-600 to-green-600 text-white rounded-lg text-sm font-medium hover:from-emerald-700 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Simpan {{ $types[$type] ?? ucfirst($type) }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Preview Card -->
        <div class="mt-8 bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Preview
                </h3>
            </div>
            <div class="p-6">
                <div id="preview-content" class="bg-gray-50 rounded-lg p-6 border-2 border-dashed border-gray-300">
                    <p class="text-gray-500 text-center">Preview akan muncul saat Anda mengisi form</p>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>

    @push('scripts')
    <script>
        // Real-time preview
        function updatePreview() {
            const type = '{{ $type }}';
            const title = document.getElementById('title').value || '';
            const content = document.getElementById('content').value || '';
            const orderPosition = document.getElementById('order_position')?.value || '';

            const previewContent = document.getElementById('preview-content');

            if (!title && !content) {
                previewContent.innerHTML = '<p class="text-gray-500 text-center">Preview akan muncul saat Anda mengisi form</p>';
                return;
            }

            let previewHTML = '';

            if (type === 'visi') {
                previewHTML = `
                    <div class="bg-gradient-to-br from-indigo-50 to-blue-50 rounded-xl p-6 border border-indigo-100">
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-indigo-100 rounded-full mb-4">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-indigo-900 mb-4">Visi</h3>
                            <p class="text-lg leading-relaxed text-gray-700 font-medium break-words whitespace-pre-wrap" style="word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">"${content || 'Konten visi...'}"</p>
                        </div>
                    </div>
                `;
            } else {
                const orderNumber = orderPosition || '1';
                previewHTML = `
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 border border-green-100">
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-green-100 rounded-full mb-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 713.138-3.138z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Misi</h3>
                        </div>
                        <div class="prose prose-gray max-w-none">
                            <p class="text-gray-700 break-words whitespace-pre-wrap" style="word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">${orderNumber}. ${content || 'Konten misi...'}</p>
                            <div class="text-left">
                                <p class="text-gray-700 break-words whitespace-pre-wrap" style="word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">${orderNumber}. ${content || 'Konten misi...'}</p>
                            </div>
                        </div>
                    </div>
                `;
            }

            previewContent.innerHTML = previewHTML;
        }

        // Add event listeners
        document.getElementById('title').addEventListener('input', updatePreview);
        document.getElementById('content').addEventListener('input', updatePreview);

        // Add order_position listener if it exists (for misi)
        const orderInput = document.getElementById('order_position');
        if (orderInput) {
            orderInput.addEventListener('input', updatePreview);
        }
    </script>
    @endpush
</x-app-layout>
