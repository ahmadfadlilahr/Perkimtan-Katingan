<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-emerald-50 via-green-50 to-teal-50">
        <div class="bg-gradient-to-r from-emerald-600 to-green-600 shadow-lg">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-white">Edit Pengguna</h1>
                            <p class="text-emerald-100 text-sm">Perbarui informasi pengguna: {{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <!-- User Avatar -->
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                            <span class="text-white text-xs font-semibold">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </span>
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
        </div>

        <div class="py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- User Info Card -->
                <div class="bg-white rounded-xl shadow-lg border border-emerald-100 mb-6">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-green-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-lg">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </span>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
                                <p class="text-gray-600 text-sm">{{ $user->email }}</p>
                                <div class="mt-1">
                                    @if($user->hasRole('super-admin'))
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>Super Admin
                                        </span>
                                    @elseif($user->hasRole('admin'))
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                            </svg>Administrator
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>Penulis
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Form -->
                <div class="bg-white rounded-2xl shadow-xl border border-emerald-100">
                    <div class="px-8 py-6">
                        <form method="POST" action="{{ route('dashboard.pengguna.update', $user) }}" class="space-y-8">
                            @csrf
                            @method('PUT')

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
                                        <p class="text-gray-600 text-sm">Perbarui data pribadi pengguna</p>
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
                                               value="{{ old('name', $user->name) }}"
                                               class="w-full px-4 py-3 border rounded-xl focus:ring-2 transition-all duration-200 {{ $errors->has('name') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-emerald-500 focus:border-emerald-500' }}"
                                               placeholder="Masukkan nama lengkap"
                                               required autofocus>
                                        @error('name')
                                            <div class="mt-2 text-sm text-red-600 bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
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
                                               value="{{ old('email', $user->email) }}"
                                               class="w-full px-4 py-3 border rounded-xl focus:ring-2 transition-all duration-200 {{ $errors->has('email') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-emerald-500 focus:border-emerald-500' }}"
                                               placeholder="contoh@email.com"
                                               required>
                                        @error('email')
                                            <div class="mt-2 text-sm text-red-600 bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
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
                                        <p class="text-gray-600 text-sm">Perbarui peran pengguna dalam sistem</p>
                                    </div>
                                </div>

                                <div>
                                    <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-user-tag mr-2 text-green-500"></i>Peran (Role)
                                    </label>
                                    <select name="role"
                                            id="role"
                                            class="w-full px-4 py-3 border rounded-xl focus:ring-2 transition-all duration-200 {{ $errors->has('role') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-green-500 focus:border-green-500' }}"
                                            required>
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}" {{ $user->hasRole($role) ? 'selected' : '' }}>
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
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                @if($user->hasRole('super-admin'))
                                    <div class="mt-4 p-4 bg-amber-50 rounded-lg border border-amber-200">
                                        <div class="flex items-start space-x-3">
                                            <i class="fas fa-exclamation-triangle text-amber-500 mt-0.5"></i>
                                            <div class="text-sm text-amber-800">
                                                <p class="font-semibold">Peringatan:</p>
                                                <p>Pengguna ini memiliki hak akses penuh sistem. Perubahan peran akan mempengaruhi kemampuan akses mereka.</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
                                        <h3 class="text-lg font-semibold text-gray-900">Ubah Password</h3>
                                        <p class="text-gray-600 text-sm">Kosongkan jika tidak ingin mengubah password</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-key mr-2 text-teal-500"></i>Password Baru
                                        </label>
                                        <input type="password"
                                               name="password"
                                               id="password"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200"
                                               placeholder="Minimal 8 karakter"
                                               autocomplete="new-password">
                                        @error('password')
                                            <div class="mt-2 text-sm text-red-600 bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-check-double mr-2 text-teal-500"></i>Konfirmasi Password
                                        </label>
                                        <input type="password"
                                               name="password_confirmation"
                                               id="password_confirmation"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200"
                                               placeholder="Ulangi password yang sama"
                                               autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="mt-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                    <div class="flex items-start space-x-3">
                                        <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                                        <div class="text-sm text-blue-800">
                                            <p class="font-semibold mb-1">Catatan Keamanan:</p>
                                            <ul class="list-disc list-inside space-y-1 text-xs">
                                                <li>Kosongkan kedua field password jika tidak ingin mengubah</li>
                                                <li>Password baru harus minimal 8 karakter</li>
                                                <li>Gunakan kombinasi huruf, angka, dan karakter khusus</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Account Status -->
                            <div class="bg-gradient-to-r from-gray-50 to-slate-50 rounded-xl p-6 border border-gray-100">
                                <div class="flex items-center space-x-3 mb-4">
                                    <div class="w-10 h-10 bg-gradient-to-r from-gray-500 to-slate-500 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-chart-line text-white"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">Status Akun</h3>
                                        <p class="text-gray-600 text-sm">Informasi aktivitas pengguna</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <div class="flex items-center space-x-3">
                                            <i class="fas fa-calendar-alt text-emerald-500"></i>
                                            <div>
                                                <p class="text-xs text-gray-500">Bergabung</p>
                                                <p class="text-sm font-semibold text-gray-900">{{ $user->created_at->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <div class="flex items-center space-x-3">
                                            <i class="fas fa-clock text-blue-500"></i>
                                            <div>
                                                <p class="text-xs text-gray-500">Terakhir Update</p>
                                                <p class="text-sm font-semibold text-gray-900">{{ $user->updated_at->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <div class="flex items-center space-x-3">
                                            <i class="fas fa-check-circle text-green-500"></i>
                                            <div>
                                                <p class="text-xs text-gray-500">Status</p>
                                                <p class="text-sm font-semibold text-green-600">Aktif</p>
                                            </div>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                                    </svg>
                                    Update Pengguna
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
