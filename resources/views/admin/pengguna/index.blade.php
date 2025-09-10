<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent">
                    Manajemen Pengguna
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola pengguna admin dan hak akses sistem
                </p>
            </div>

        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 relative">
                    <div class="bg-gradient-to-r from-emerald-50 to-green-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg shadow-sm" role="alert">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium">{{ session('success') }}</p>
                            </div>
                            <div class="ml-auto pl-3">
                                <div class="-mx-1.5 -my-1.5">
                                    <button type="button" class="inline-flex bg-emerald-50 rounded-md p-1.5 text-emerald-500 hover:bg-emerald-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-emerald-50 focus:ring-emerald-600" onclick="this.parentElement.parentElement.parentElement.parentElement.remove()">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Error Message --}}
            @if (session('error'))
                <div class="mb-6 relative">
                    <div class="bg-gradient-to-r from-red-50 to-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg shadow-sm" role="alert">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Statistics Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-green-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Total Pengguna</h3>
                            <p class="text-3xl font-bold text-emerald-600">{{ $users->total() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Super Admin</h3>
                            <p class="text-3xl font-bold text-blue-600">{{ $users->filter(function($user) { return $user->hasRole('super-admin'); })->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-violet-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Admin</h3>
                            <p class="text-3xl font-bold text-purple-600">{{ $users->filter(function($user) { return $user->hasRole('admin'); })->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Content Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                {{-- Header --}}
                <div class="border-b border-gray-200 bg-gradient-to-r from-emerald-50 to-green-50 px-6 py-4">
                    <div class="flex items-center justify-between">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                                Daftar Pengguna Admin
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">
                                Kelola dan atur hak akses pengguna sistem
                            </p>
                        </div>
                        <a href="{{ route('dashboard.pengguna.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Tambah Pengguna Baru
                        </a>
                    </div>
                </div>

                {{-- Table --}}
                <div class="overflow-hidden">
                    @if($users->count() > 0)
                        {{-- Desktop Table View (Hidden on mobile) --}}
                        <div class="hidden lg:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Pengguna
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Peran (Role)
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($users as $user)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-green-600 rounded-full flex items-center justify-center">
                                                            <span class="text-sm font-bold text-white">
                                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                        <div class="text-sm text-gray-500">Bergabung {{ $user->created_at->diffForHumans() }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                                <div class="text-sm text-gray-500">{{ $user->email_verified_at ? 'Terverifikasi' : 'Belum verifikasi' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $role = $user->getRoleNames()->first() ?? 'Tanpa Peran';
                                                @endphp
                                                @if($role === 'super-admin')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-purple-100 to-indigo-100 text-purple-800 border border-purple-200">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                                        </svg>
                                                        Super Admin
                                                    </span>
                                                @elseif($role === 'admin')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-800 border border-emerald-200">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                        </svg>
                                                        Admin
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-200">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                                        </svg>
                                                        {{ ucfirst($role) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                                <div class="flex items-center space-x-2">
                                                    <a href="{{ route('dashboard.pengguna.edit', $user) }}"
                                                       class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-emerald-100 to-green-100 hover:from-emerald-200 hover:to-green-200 text-emerald-700 text-xs font-medium rounded-lg border border-emerald-200 transition-all duration-200">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                        Edit
                                                    </a>

                                                    @if(auth()->id() !== $user->id)
                                                        <form action="{{ route('dashboard.pengguna.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-red-100 to-red-200 hover:from-red-200 hover:to-red-300 text-red-700 text-xs font-medium rounded-lg border border-red-200 transition-all duration-200">
                                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                                </svg>
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-400 bg-gray-100 rounded-lg border border-gray-200">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                            </svg>
                                                            Anda
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Mobile Card View (Visible on mobile, hidden on desktop) --}}
                        <div class="lg:hidden space-y-4 p-4">
                            @foreach ($users as $user)
                                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                                    {{-- Header with user info --}}
                                    <div class="flex items-start space-x-4 mb-3">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-full flex items-center justify-center">
                                                <span class="text-sm font-bold text-white">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-sm font-semibold text-gray-900">
                                                {{ $user->name }}
                                            </h3>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $user->email }}
                                            </p>
                                            <p class="text-xs text-gray-400 mt-1">
                                                Bergabung {{ $user->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            @php
                                                $role = $user->getRoleNames()->first() ?? 'Tanpa Peran';
                                            @endphp
                                            @if($role === 'super-admin')
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-purple-100 to-indigo-100 text-purple-800 border border-purple-200">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                                    </svg>
                                                    Super Admin
                                                </span>
                                            @elseif($role === 'admin')
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-800 border border-emerald-200">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                    Admin
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-200">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                                    </svg>
                                                    {{ ucfirst($role) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Email verification status --}}
                                    <div class="mb-3">
                                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium {{ $user->email_verified_at ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-yellow-100 text-yellow-800 border border-yellow-200' }}">
                                            @if($user->email_verified_at)
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Email Terverifikasi
                                            @else
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                </svg>
                                                Belum Verifikasi
                                            @endif
                                        </span>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                        <div class="text-xs text-gray-500">
                                            ID: {{ $user->id }}
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('dashboard.pengguna.edit', $user) }}"
                                               class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-emerald-100 to-green-100 hover:from-emerald-200 hover:to-green-200 text-emerald-700 text-xs font-medium rounded-lg border border-emerald-200 transition-all duration-200">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>

                                            @if(auth()->id() !== $user->id)
                                                <form action="{{ route('dashboard.pengguna.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-red-100 to-red-200 hover:from-red-200 hover:to-red-300 text-red-700 text-xs font-medium rounded-lg border border-red-200 transition-all duration-200">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-400 bg-gray-100 rounded-lg border border-gray-200">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                    </svg>
                                                    Anda
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        {{-- Empty State --}}
                        <div class="text-center py-12 px-4">
                            <div class="mx-auto w-20 h-20 lg:w-24 lg:h-24 bg-gradient-to-br from-emerald-100 to-green-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-10 h-10 lg:w-12 lg:h-12 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-base lg:text-lg font-semibold text-gray-900 mb-2">
                                Belum Ada Pengguna
                            </h3>
                            <p class="text-sm lg:text-base text-gray-600 mb-6 max-w-sm mx-auto">
                                Belum ada pengguna yang terdaftar. Tambahkan pengguna pertama untuk memulai.
                            </p>
                            <a href="{{ route('dashboard.pengguna.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Tambah Pengguna Pertama
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Pagination --}}
                @if($users->hasPages())
                <div class="border-t border-gray-200 bg-gray-50/50 px-4 lg:px-6 py-4">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-3 lg:space-y-0">
                        <div class="text-xs lg:text-sm text-gray-700 text-center lg:text-left">
                            Menampilkan {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }}
                            dari {{ $users->total() }} pengguna
                        </div>
                        <div class="flex items-center justify-center lg:justify-end">
                            {{ $users->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
