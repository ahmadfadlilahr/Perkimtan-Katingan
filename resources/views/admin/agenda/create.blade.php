<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent">
                    Tambah Agenda Baru
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Buat agenda kegiatan atau acara baru untuk dinas
                </p>
            </div>
            <a href="{{ route('dashboard.agenda.index') }}"
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
            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="mb-6 relative">
                    <div class="bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg shadow-sm" role="alert">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium">Terdapat kesalahan dalam form:</h3>
                                <ul class="mt-2 text-sm list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Form --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <form action="{{ route('dashboard.agenda.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="px-6 py-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Agenda</h3>
                        <p class="mt-1 text-sm text-gray-600">Lengkapi informasi dasar agenda yang akan dibuat.</p>
                    </div>

                    <div class="px-6 space-y-6">
                        {{-- Judul --}}
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                                Judul Agenda <span class="text-red-500">*</span>
                            </label>
                            <x-form.input
                                name="judul"
                                placeholder="Masukkan judul agenda..."
                                required
                            />
                        </div>

                        {{-- Konten --}}
                        <div>
                            <label for="konten" class="block text-sm font-medium text-gray-700 mb-2">
                                Konten Agenda <span class="text-red-500">*</span>
                            </label>
                            @php
                                $textareaClass = 'w-full rounded-lg shadow-sm ';
                                $textareaClass .= $errors->has('konten')
                                    ? 'border-red-300 focus:border-red-500 focus:ring-red-500'
                                    : 'border-gray-300 focus:border-emerald-500 focus:ring-emerald-500';
                            @endphp
                            <textarea
                                id="konten"
                                name="konten"
                                rows="8"
                                placeholder="Masukkan konten detail agenda..."
                                class="{{ $textareaClass }}"
                                required>{{ old('konten') }}</textarea>
                            @error('konten')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal & Waktu --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="tanggal_agenda" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Agenda <span class="text-red-500">*</span>
                                </label>
                                <x-form.input
                                    name="tanggal_agenda"
                                    type="date"
                                    min="{{ date('Y-m-d') }}"
                                    required
                                />
                            </div>

                            <div>
                                <label for="waktu_mulai" class="block text-sm font-medium text-gray-700 mb-2">
                                    Waktu Mulai <span class="text-red-500">*</span>
                                </label>
                                <x-form.input
                                    name="waktu_mulai"
                                    type="time"
                                    required
                                />
                            </div>

                            <div>
                                <label for="waktu_selesai" class="block text-sm font-medium text-gray-700 mb-2">
                                    Waktu Selesai
                                </label>
                                <x-form.input
                                    name="waktu_selesai"
                                    type="time"
                                />
                            </div>
                        </div>

                        {{-- Lokasi --}}
                        <div>
                            <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">
                                Lokasi <span class="text-red-500">*</span>
                            </label>
                            <x-admin.form-input
                                name="lokasi"
                                placeholder="Masukkan lokasi agenda..."
                                required="true"
                            />
                        </div>

                        {{-- Penyelenggara --}}
                        <div>
                            <label for="penyelenggara" class="block text-sm font-medium text-gray-700 mb-2">
                                Penyelenggara
                            </label>
                            <x-admin.form-input
                                name="penyelenggara"
                                placeholder="Masukkan nama penyelenggara..."
                            />
                        </div>

                        {{-- Kategori & Status --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <x-admin.form-input
                                    name="kategori"
                                    type="select"
                                    required="true"
                                    :options="[
                                        '' => 'Pilih Kategori',
                                        'rapat' => 'Rapat',
                                        'sosialisasi' => 'Sosialisasi',
                                        'workshop' => 'Workshop',
                                        'acara_publik' => 'Acara Publik'
                                    ]"
                                />
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <x-admin.form-input
                                    name="status"
                                    type="select"
                                    required="true"
                                    :options="[
                                        '' => 'Pilih Status',
                                        'draft' => 'Draft',
                                        'published' => 'Terpublikasi',
                                        'selesai' => 'Selesai',
                                        'dibatalkan' => 'Dibatalkan'
                                    ]"
                                />
                            </div>
                        </div>

                        {{-- Prioritas --}}
                        <div>
                            <label for="prioritas" class="block text-sm font-medium text-gray-700 mb-2">
                                Prioritas <span class="text-red-500">*</span>
                            </label>
                            <x-admin.form-input
                                name="prioritas"
                                type="select"
                                required="true"
                                :options="[
                                    '' => 'Pilih Prioritas',
                                    'rendah' => 'Rendah',
                                    'sedang' => 'Sedang',
                                    'tinggi' => 'Tinggi',
                                    'mendesak' => 'Mendesak'
                                ]"
                            />
                        </div>

                        {{-- Opsi Publikasi --}}
                        <div class="space-y-4">
                            <h4 class="text-sm font-medium text-gray-900">Pengaturan Publikasi</h4>

                            <div class="flex items-center">
                                <input type="hidden" name="is_publik" value="0">
                                <input type="checkbox"
                                       id="is_publik"
                                       name="is_publik"
                                       value="1"
                                       {{ old('is_publik') ? 'checked' : '' }}
                                       class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                                <label for="is_publik" class="ml-2 block text-sm text-gray-900">
                                    Agenda ini dapat dilihat oleh publik
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox"
                                       id="is_featured"
                                       name="is_featured"
                                       value="1"
                                       {{ old('is_featured') ? 'checked' : '' }}
                                       class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                                <label for="is_featured" class="ml-2 block text-sm text-gray-900">
                                    Tampilkan sebagai agenda unggulan
                                </label>
                            </div>
                        </div>

                        {{-- File Upload --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                                    Gambar Agenda
                                </label>
                                @php
                                    $gambarInputClass = 'w-full rounded-lg shadow-sm ';
                                    $gambarInputClass .= $errors->has('gambar')
                                        ? 'border-red-300 focus:border-red-500 focus:ring-red-500'
                                        : 'border-gray-300 focus:border-emerald-500 focus:ring-emerald-500';
                                @endphp
                                <input type="file"
                                       id="gambar"
                                       name="gambar"
                                       accept="image/*"
                                       class="{{ $gambarInputClass }}">
                                <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                                @error('gambar')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="lampiran" class="block text-sm font-medium text-gray-700 mb-2">
                                    Lampiran Dokumen
                                </label>
                                @php
                                    $lampiranInputClass = 'w-full rounded-lg shadow-sm ';
                                    $lampiranInputClass .= $errors->has('lampiran')
                                        ? 'border-red-300 focus:border-red-500 focus:ring-red-500'
                                        : 'border-gray-300 focus:border-emerald-500 focus:ring-emerald-500';
                                @endphp
                                <input type="file"
                                       id="lampiran"
                                       name="lampiran"
                                       accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx"
                                       class="{{ $lampiranInputClass }}">
                                <p class="mt-1 text-xs text-gray-500">Format: PDF, DOC, XLS, PPT. Maksimal 10MB.</p>
                                @error('lampiran')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                        <a href="{{ route('dashboard.agenda.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-50 border border-gray-300 rounded-lg font-medium text-sm text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                            Batal
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Simpan Agenda
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
