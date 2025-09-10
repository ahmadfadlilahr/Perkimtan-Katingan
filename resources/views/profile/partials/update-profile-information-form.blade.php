<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name"
                       name="name"
                       type="text"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                       value="{{ old('name', $user->name) }}"
                       required
                       autofocus
                       autocomplete="name">
                @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email"
                       name="email"
                       type="email"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                       value="{{ old('email', $user->email) }}"
                       required
                       autocomplete="username">
                @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <p class="text-sm text-yellow-800">
                            Your email address is unverified.
                            <button form="send-verification"
                                    class="ml-1 underline text-yellow-700 hover:text-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 rounded">
                                Click here to re-send the verification email.
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm text-green-700">
                                A new verification link has been sent to your email address.
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
            <div class="flex items-center space-x-4">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Save Changes
                </button>

                @if (session('status') === 'profile-updated')
                    <div x-data="{ show: true }"
                         x-show="show"
                         x-transition
                         x-init="setTimeout(() => show = false, 3000)"
                         class="flex items-center text-sm text-green-600">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Profile updated successfully!
                    </div>
                @endif
            </div>
        </div>
    </form>
</section>
