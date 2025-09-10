{{-- resources/views/components/admin/welcome-card.blade.php --}}
@props([
    'user' => null,
    'class' => ''
])

<div class="bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-xl p-6 text-white {{ $class }}">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
        </div>
        <div class="ml-4">
            <h2 class="text-xl font-bold">
                Selamat datang kembali, {{ $user ? $user->name : 'Admin' }}!
            </h2>
            <p class="text-indigo-100 mt-1">
                Kelola konten website Dinas Perkim dengan mudah dari dashboard ini.
            </p>
        </div>
    </div>

    <div class="mt-4 pt-4 border-t border-indigo-400/30">
        <div class="flex items-center text-sm text-indigo-100">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Terakhir login: {{ $user && $user->last_login_at ? $user->last_login_at->format('d M Y, H:i') : 'Hari ini' }}</span>
        </div>
    </div>
</div>
