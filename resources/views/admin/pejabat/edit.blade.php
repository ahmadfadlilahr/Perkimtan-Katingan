<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Edit Data Pejabat
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Perbarui informasi pejabat dalam struktur organisasi
                </p>
            </div>
            <a href="{{ route('dashboard.pejabat.index') }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <form method="POST" action="{{ route('dashboard.pejabat.update', $pejabat) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-8">
                    {{-- Basic Information Section --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="border-b border-gray-200 bg-gray-50/50 px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center">
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
                                        Perbarui nama dan identitas pejabat
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 space-y-6">
                            <div>
                                <x-input-label for="nama" class="text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap *
                                </x-input-label>
                                <x-text-input id="nama"
                                              class="block w-full"
                                              type="text"
                                              name="nama"
                                              :value="old('nama', $pejabat->nama)"
                                              placeholder="Masukkan nama lengkap pejabat..."
                                              required
                                              autofocus />
                                <p class="mt-1 text-xs text-gray-500">Nama akan ditampilkan di struktur organisasi</p>
                                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="nip" class="text-sm font-medium text-gray-700 mb-2">
                                    NIP (Nomor Induk Pegawai)
                                </x-input-label>
                                <x-text-input id="nip"
                                              class="block w-full"
                                              type="text"
                                              name="nip"
                                              :value="old('nip', $pejabat->nip)"
                                              placeholder="Masukkan NIP jika ada..." />
                                <p class="mt-1 text-xs text-gray-500">Kosongkan jika pejabat belum memiliki NIP</p>
                                <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- Position Information Section --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden" x-data="{
                        selectedJabatan: '{{ old('jabatan_dasar', $jabatanDasar) }}',
                        jabatanDasar: '{{ old('jabatan_dasar', $jabatanDasar) }}'
                    }">
                        <div class="border-b border-gray-200 bg-gray-50/50 px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 00-2 2H10a2 2 0 00-2-2V6m8 0h2a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2h2"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        Informasi Jabatan
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        Perbarui jabatan dan posisi dalam struktur organisasi
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 space-y-6">
                            <div>
                                <x-input-label for="jabatan_dasar" class="text-sm font-medium text-gray-700 mb-2">
                                    Jabatan Dasar *
                                </x-input-label>
                                <select id="jabatan_dasar"
                                        name="jabatan_dasar"
                                        x-model="selectedJabatan"
                                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                                        required>
                                    @php
                                        $jabatanOptions = [
                                            'Kepala Dinas' => '🏢 Kepala Dinas',
                                            'Sekretaris' => '📋 Sekretaris',
                                            'Kepala Bidang' => '👔 Kepala Bidang',
                                            'Kasubag' => '👥 Kasubag (Kepala Sub Bagian)',
                                            'Kepala Seksi' => '� Kepala Seksi'
                                        ];
                                    @endphp
                                    <option value="">Pilih Jabatan</option>
                                    @foreach($jabatanOptions as $value => $label)
                                        <option value="{{ $value }}" {{ $jabatanDasar == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="mt-1 text-xs text-gray-500">Pilih jabatan sesuai dengan struktur organisasi</p>
                                <x-input-error :messages="$errors->get('jabatan_dasar')" class="mt-2" />
                            </div>

                            {{-- Input tambahan untuk Kepala Bidang --}}
                            <div x-show="jabatanDasar === 'Kepala Bidang'" x-transition class="space-y-4">
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <p class="text-sm text-blue-800">Karena jabatan yang dipilih adalah Kepala Bidang, silakan tentukan nama bidangnya.</p>
                                    </div>
                                </div>
                                <div>
                                    <x-input-label for="nama_bidang" class="text-sm font-medium text-gray-700 mb-2">
                                        Nama Bidang *
                                    </x-input-label>
                                                                            <input type="text"
                                               id="nama_bidang"
                                               name="nama_bidang"
                                               value="{{ old('nama_bidang', $namaBidang) }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                               placeholder="Masukkan nama bidang">
                                    </div>
                                </div>

                                <!-- Kasubag Dynamic Section -->
                                <div x-show="selectedJabatan === 'Kasubag'"
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0 transform scale-95"
                                     x-transition:enter-end="opacity-100 transform scale-100"
                                     x-transition:leave="transition ease-in duration-200"
                                     x-transition:leave-start="opacity-100 transform scale-100"
                                     x-transition:leave-end="opacity-0 transform scale-95"
                                     class="bg-green-50 border border-green-200 rounded-lg p-4 mt-4">
                                    <div class="flex items-center mb-3">
                                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                        <h4 class="text-green-800 font-semibold">Detail Kasubag</h4>
                                    </div>
                                    <div>
                                        <label for="nama_subbag" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Sub Bagian
                                        </label>
                                        <input type="text"
                                               id="nama_subbag"
                                               name="nama_subbag"
                                               value="{{ old('nama_subbag', $namaSubbag) }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                               placeholder="Masukkan nama sub bagian">
                                    </div>
                                </div>

                                <!-- Kepala Seksi Dynamic Section -->
                                <div x-show="selectedJabatan === 'Kepala Seksi'"
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0 transform scale-95"
                                     x-transition:enter-end="opacity-100 transform scale-100"
                                     x-transition:leave="transition ease-in duration-200"
                                     x-transition:leave-start="opacity-100 transform scale-100"
                                     x-transition:leave-end="opacity-0 transform scale-95"
                                     class="bg-purple-50 border border-purple-200 rounded-lg p-4 mt-4">
                                    <div class="flex items-center mb-3">
                                        <div class="w-3 h-3 bg-purple-500 rounded-full mr-2"></div>
                                        <h4 class="text-purple-800 font-semibold">Detail Kepala Seksi</h4>
                                    </div>
                                    <div>
                                        <label for="nama_seksi" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Seksi
                                        </label>
                                        <input type="text"
                                               id="nama_seksi"
                                               name="nama_seksi"
                                               value="{{ old('nama_seksi', $namaSeksi) }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                               placeholder="Masukkan nama seksi">
                                    </div>
                                </div>
                                    <p class="mt-1 text-xs text-gray-500">Nama bidang akan ditampilkan sebagai bagian dari jabatan</p>
                                    <x-input-error :messages="$errors->get('nama_bidang')" class="mt-2" />
                                </div>
                            </div>

                            {{-- Input tambahan untuk Kasubag --}}
                            <div x-show="jabatanDasar === 'Kasubag'" x-transition class="space-y-4">
                                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        <p class="text-sm text-green-800">Kasubag adalah Kepala Sub Bagian. Silakan tentukan nama sub bagiannya.</p>
                                    </div>
                                </div>
                                <div>
                                    <x-input-label for="nama_subbag" class="text-sm font-medium text-gray-700 mb-2">
                                        Nama Sub Bagian *
                                    </x-input-label>
                                    <x-text-input id="nama_subbag"
                                                  class="block w-full"
                                                  type="text"
                                                  name="nama_subbag"
                                                  :value="old('nama_subbag', $namaSubbag)"
                                                  placeholder="Contoh: Umum dan Kepegawaian, Keuangan, dll..." />
                                    <p class="mt-1 text-xs text-gray-500">Nama sub bagian akan ditampilkan sebagai bagian dari jabatan</p>
                                    <x-input-error :messages="$errors->get('nama_subbag')" class="mt-2" />
                                </div>
                            </div>

                            {{-- Input tambahan untuk Kepala Seksi --}}
                            <div x-show="jabatanDasar === 'Kepala Seksi'" x-transition class="space-y-4">
                                <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                        </svg>
                                        <p class="text-sm text-purple-800">Kepala Seksi mengelola seksi tertentu. Silakan tentukan nama seksinya.</p>
                                    </div>
                                </div>
                                <div>
                                    <x-input-label for="nama_seksi" class="text-sm font-medium text-gray-700 mb-2">
                                        Nama Seksi *
                                    </x-input-label>
                                    <x-text-input id="nama_seksi"
                                                  class="block w-full"
                                                  type="text"
                                                  name="nama_seksi"
                                                  :value="old('nama_seksi', $namaSeksi)"
                                                  placeholder="Contoh: Penataan Bangunan, Infrastruktur, dll..." />
                                    <p class="mt-1 text-xs text-gray-500">Nama seksi akan ditampilkan sebagai bagian dari jabatan</p>
                                    <x-input-error :messages="$errors->get('nama_seksi')" class="mt-2" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="urutan" class="text-sm font-medium text-gray-700 mb-2">
                                    Nomor Urut Tampil *
                                </x-input-label>
                                <x-text-input id="urutan"
                                              class="block w-full"
                                              type="number"
                                              name="urutan"
                                              :value="old('urutan', $pejabat->urutan)"
                                              min="0"
                                              placeholder="0"
                                              required />
                                <p class="mt-1 text-xs text-gray-500">Urutan tampil di struktur organisasi (0 = paling atas)</p>
                                <x-input-error :messages="$errors->get('urutan')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- Current Photo & Upload Section --}}
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
                                        Foto Pejabat
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        Foto saat ini dan opsi untuk menggantinya
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="space-y-6">
                                {{-- Current Photo Preview --}}
                                <div>
                                    <label class="text-sm font-medium text-gray-700 mb-3 block">
                                        Foto Saat Ini
                                    </label>
                                    @if($pejabat->foto)
                                        <div class="relative inline-block">
                                            <img src="{{ asset('storage/pejabat/' . $pejabat->foto) }}"
                                                 alt="{{ $pejabat->nama }}"
                                                 class="w-full max-w-md h-48 object-cover rounded-lg shadow-sm border border-gray-200">
                                            <div class="absolute top-2 right-2">
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-white/90 text-gray-700 border border-gray-200">
                                                    {{ $pejabat->foto }}
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="w-full max-w-md h-48 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center">
                                            <div class="text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                <p class="mt-2 text-sm text-gray-500">Tidak ada foto</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- Upload New Photo --}}
                                <div>
                                    <x-input-label for="foto" class="text-sm font-medium text-gray-700 mb-2">
                                        Ganti Foto (Opsional)
                                    </x-input-label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors duration-200">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="foto" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <span>Upload foto baru</span>
                                                    <input id="foto" name="foto" type="file" class="sr-only" accept="image/*" onchange="previewImage(event)">
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
                                        Kosongkan jika tidak ingin mengganti foto yang sudah ada
                                    </div>
                                    <x-input-error :messages="$errors->get('foto')" class="mt-2" />

                                    {{-- New Photo Preview --}}
                                    <div class="mt-4">
                                        <img id="imagePreview"
                                             class="hidden w-full max-w-md h-48 object-cover rounded-lg shadow-sm border border-gray-200 mt-4"
                                             alt="Preview foto baru">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <a href="{{ route('dashboard.pejabat.index') }}"
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batal
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Update Pejabat
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    preview.classList.add('block');
                }
                reader.readAsDataURL(file);
            } else {
                preview.classList.remove('block');
                preview.classList.add('hidden');
                preview.src = '';
            }
        }
    </script>
</x-app-layout>
