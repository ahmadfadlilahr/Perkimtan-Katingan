<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="space-y-4">
            <div class="space-y-2">
                <label for="update_password_current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                <input id="update_password_current_password"
                       name="current_password"
                       type="password"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                       autocomplete="current-password">
                @error('current_password', 'updatePassword')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="update_password_password" class="block text-sm font-medium text-gray-700">New Password</label>
                    <input id="update_password_password"
                           name="password"
                           type="password"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                           autocomplete="new-password">
                    @error('password', 'updatePassword')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="update_password_password_confirmation"
                           name="password_confirmation"
                           type="password"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                           autocomplete="new-password">
                    @error('password_confirmation', 'updatePassword')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
            <div class="flex items-center space-x-4">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Update Password
                </button>

                @if (session('status') === 'password-updated')
                    <div x-data="{ show: true }"
                         x-show="show"
                         x-transition
                         x-init="setTimeout(() => show = false, 3000)"
                         class="flex items-center text-sm text-green-600">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Password updated successfully!
                    </div>
                @endif
            </div>

            <div class="text-xs text-gray-500">
                <p>Use at least 8 characters with a mix of letters, numbers & symbols</p>
            </div>
        </div>
    </form>
</section>
