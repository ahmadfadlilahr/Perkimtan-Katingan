<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <!-- Already Logged In Warning -->
    @auth
        <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-xl">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <div>
                    <p class="font-semibold">Anda sudah login sebagai {{ Auth::user()->name }}</p>
                    <div class="mt-1 text-sm">
                        <a href="{{ route('dashboard') }}" class="font-medium hover:underline">Ke Dashboard</a> atau
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="font-medium hover:underline text-yellow-700">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth

    <!-- Login Header -->
    <div class="text-center mb-4">
        <x-ui.text-gradient variant="primary" size="lg" as="h2" class="mb-1">
            Masuk ke Admin
        </x-ui.text-gradient>
        <p class="text-xs text-gray-600">Silakan masukkan kredensial Anda untuk mengakses dashboard</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 text-sm font-medium" />
            <x-text-input id="email"
                          class="block mt-1 w-full rounded-lg border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors duration-200"
                          type="email"
                          name="email"
                          :value="old('email')"
                          required
                          autofocus
                          autocomplete="username"
                          placeholder="admin@dinasperkim.go.id" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 text-sm font-medium" />
            <div class="relative">
                <x-text-input id="password"
                              class="block mt-1 w-full pr-10 rounded-lg border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors duration-200"
                              type="password"
                              name="password"
                              required
                              autocomplete="current-password"
                              placeholder="••••••••" />

                <!-- Toggle Password Visibility Button -->
                <button type="button"
                        id="toggle-password"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none transition-colors duration-200"
                        onclick="togglePasswordVisibility()">
                    <!-- Eye Icon (Show) -->
                    <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <!-- Eye Slash Icon (Hide) - Hidden by default -->
                    <svg id="eye-slash-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me"
                       type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 focus:ring-offset-0"
                       name="remember">
                <span class="ms-2 text-xs text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs text-indigo-600 hover:text-indigo-500 transition-colors duration-200 font-medium" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-2.5 px-4 rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                {{ __('Masuk ke Dashboard') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Additional Information -->
    <div class="mt-4 pt-3 border-t border-gray-200">
        <div class="flex items-center justify-center text-xs text-gray-500">
            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
            </svg>
            Akses terlindungi dengan keamanan tinggi
        </div>
    </div>

    <!-- JavaScript untuk Toggle Password Visibility -->
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeSlashIcon = document.getElementById('eye-slash-icon');

            // Toggle input type
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        }

        // Optional: Hide password when clicking outside or on escape
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeSlashIcon = document.getElementById('eye-slash-icon');

            // Hide password on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && passwordInput.type === 'text') {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('hidden');
                    eyeSlashIcon.classList.add('hidden');
                }
            });

            // Optional: Auto-hide password after some time of inactivity
            let hideTimer;
            passwordInput.addEventListener('input', function() {
                if (passwordInput.type === 'text') {
                    clearTimeout(hideTimer);
                    hideTimer = setTimeout(function() {
                        passwordInput.type = 'password';
                        eyeIcon.classList.remove('hidden');
                        eyeSlashIcon.classList.add('hidden');
                    }, 10000); // Hide after 10 seconds of inactivity
                }
            });
        });
    </script>
</x-guest-layout>
