<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Profile</h2>
                <p class="text-gray-600">Kelola informasi akun dan pengaturan keamanan Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-8">
                {{-- Profile Information Card --}}
                <x-admin.card>
                    <x-slot name="header">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Profile Information</h3>
                                <p class="text-sm text-gray-600">Update your account's profile information and email address.</p>
                            </div>
                        </div>
                    </x-slot>

                    @include('profile.partials.update-profile-information-form')
                </x-admin.card>

                {{-- Password Update Card --}}
                <x-admin.card>
                    <x-slot name="header">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Update Password</h3>
                                <p class="text-sm text-gray-600">Ensure your account is using a long, random password to stay secure.</p>
                            </div>
                        </div>
                    </x-slot>

                    @include('profile.partials.update-password-form')
                </x-admin.card>

                {{-- Delete Account Card --}}
                <x-admin.card>
                    <x-slot name="header">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Delete Account</h3>
                                <p class="text-sm text-gray-600">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                            </div>
                        </div>
                    </x-slot>

                    @include('profile.partials.delete-user-form')
                </x-admin.card>
            </div>
        </div>
    </div>
</x-app-layout>
