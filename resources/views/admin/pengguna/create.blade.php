<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-emerald-50 via-green-50 to-teal-50">
        <div class="bg-gradient-to-r from-emerald-600 to-green-600 shadow-lg">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-white">Tambah Pengguna Baru</h1>
                            <p class="text-emerald-100 text-sm">Buat akun pengguna baru untuk sistem</p>
                        </div>
                    </div>
                    <a href="{{ route('dashboard.pengguna.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-lg transition-all duration-200 backdrop-blur-sm border border-white/20">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-xl border border-emerald-100">
                    <div class="px-8 py-6">
                        <form method="POST" action="{{ route('dashboard.pengguna.store') }}" class="space-y-8">
                            @csrf

                            <!-- Personal Information Section -->
                            <div class="bg-gradient-to-r from-emerald-50 to-green-50 rounded-xl p-6 border border-emerald-100">
                                <div class="flex items-center space-x-3 mb-6">
                                    <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-green-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">Informasi Personal</h3>
                                        <p class="text-gray-600 text-sm">Data pribadi pengguna</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <svg class="w-4 h-4 mr-2 text-emerald-500 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>Nama Lengkap
                                        </label>
                                        <input type="text"
                                               name="name"
                                               id="name"
                                               value="{{ old('name') }}"
                                               class="w-full px-4 py-3 border rounded-xl focus:ring-2 transition-all duration-200 {{ $errors->has('name') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-emerald-500 focus:border-emerald-500' }}"
                                               placeholder="Masukkan nama lengkap"
                                               required autofocus>
                                        @error('name')
                                            <div class="mt-2 text-sm text-red-600 bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                                <svg class="w-4 h-4 mr-1 inline" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <svg class="w-4 h-4 mr-2 text-emerald-500 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>Alamat Email
                                        </label>
                                        <input type="email"
                                               name="email"
                                               id="email"
                                               value="{{ old('email') }}"
                                               class="w-full px-4 py-3 border rounded-xl focus:ring-2 transition-all duration-200 {{ $errors->has('email') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-emerald-500 focus:border-emerald-500' }}"
                                               placeholder="contoh@email.com"
                                               required>
                                        @error('email')
                                            <div class="mt-2 text-sm text-red-600 bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                                <svg class="w-4 h-4 mr-1 inline" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Role & Permission Section -->
                            <div class="bg-gradient-to-r from-green-50 to-teal-50 rounded-xl p-6 border border-green-100">
                                <div class="flex items-center space-x-3 mb-6">
                                    <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-teal-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">Peran & Hak Akses</h3>
                                        <p class="text-gray-600 text-sm">Tentukan peran pengguna dalam sistem</p>
                                    </div>
                                </div>

                                <div>
                                    <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <svg class="w-4 h-4 mr-2 text-green-500 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>Peran (Role)
                                    </label>
                                    <select name="role"
                                            id="role"
                                            class="w-full px-4 py-3 border rounded-xl focus:ring-2 transition-all duration-200 {{ $errors->has('role') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-green-500 focus:border-green-500' }}"
                                            required>
                                        <option value="">Pilih Peran Pengguna</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                                                {{ ucfirst($role) }}
                                                @if($role === 'super-admin')
                                                    - Akses Penuh Sistem
                                                @elseif($role === 'admin')
                                                    - Kelola Konten & Pengguna
                                                @else
                                                    - Kelola Konten
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <div class="mt-2 text-sm text-red-600 bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                            <svg class="w-4 h-4 mr-1 inline" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Security Section -->
                            <div class="bg-gradient-to-r from-teal-50 to-emerald-50 rounded-xl p-6 border border-teal-100">
                                <div class="flex items-center space-x-3 mb-6">
                                    <div class="w-10 h-10 bg-gradient-to-r from-teal-500 to-emerald-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">Keamanan Akun</h3>
                                        <p class="text-gray-600 text-sm">Buat password yang kuat untuk keamanan</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <svg class="w-4 h-4 mr-2 text-teal-500 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 12H9v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.764l4.243-4.243A6 6 0 0115 7z"/>
                                            </svg>Password
                                        </label>
                                        <input type="password"
                                               name="password"
                                               id="password"
                                               class="w-full px-4 py-3 border rounded-xl focus:ring-2 transition-all duration-200 {{ $errors->has('password') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-teal-500 focus:border-teal-500' }}"
                                               placeholder="Minimal 8 karakter"
                                               required>
                                        @error('password')
                                            <div class="mt-2 text-sm text-red-600 bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                                <svg class="w-4 h-4 mr-1 inline" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <svg class="w-4 h-4 mr-2 text-teal-500 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>Konfirmasi Password
                                        </label>
                                        <input type="password"
                                               name="password_confirmation"
                                               id="password_confirmation"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200"
                                               placeholder="Ulangi password yang sama"
                                               required>
                                    </div>
                                </div>

                                <div class="mt-4 p-4 bg-amber-50 rounded-lg border border-amber-200">
                                    <div class="flex items-start space-x-3">
                                        <svg class="w-5 h-5 text-amber-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                        <div class="text-sm text-amber-800">
                                            <p class="font-semibold mb-1">Tips Password Kuat:</p>
                                            <ul class="list-disc list-inside space-y-1 text-xs">
                                                <li>Minimal 8 karakter</li>
                                                <li>Kombinasi huruf besar, kecil, angka</li>
                                                <li>Gunakan karakter khusus (!@#$%)</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                                <a href="{{ route('dashboard.pengguna.index') }}"
                                   class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 rounded-xl font-medium transition-all duration-200 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Batal
                                </a>

                                <button type="submit"
                                        class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transform hover:-translate-y-0.5">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Buat Pengguna
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
