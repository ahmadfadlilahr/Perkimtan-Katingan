<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold leading-tight text-gray-900">
                    Manajemen Visi Misi
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola visi dan misi organisasi
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="mb-6 relative">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg shadow-sm" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button type="button" class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none" onclick="this.parentElement.parentElement.parentElement.parentElement.remove()">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 relative">
            <div class="bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg shadow-sm" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button type="button" class="inline-flex bg-red-50 rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none" onclick="this.parentElement.parentElement.parentElement.parentElement.remove()">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Type Filter Tabs -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <div class="border-b border-gray-200">
            <div class="flex items-center justify-between px-6">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    @foreach($types as $typeKey => $typeName)
                        <a href="{{ route('dashboard.visi-misi.index', ['type' => $typeKey]) }}"
                           class="flex items-center py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 {{ $type === $typeKey ? 'border-emerald-500 text-emerald-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($typeKey === 'visi')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                @endif
                            </svg>
                            {{ $typeName }}
                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $allVisiMisiItems->where('type', $typeKey)->count() }}
                            </span>
                        </a>
                    @endforeach
                </nav>

                <!-- Additional Create Button -->
                <div class="py-4">
                    <a href="{{ route('dashboard.visi-misi.create', ['type' => $type]) }}"
                       class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200"
                       title="Tambah {{ $types[$type] ?? ucfirst($type) }} Baru">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambah {{ $types[$type] ?? ucfirst($type) }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    @if($type === 'visi')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    @endif
                </svg>
                <h3 class="text-lg font-semibold text-gray-900">Data {{ $types[$type] ?? ucfirst($type) }}</h3>
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                @if($visiMisiItems->count() > 1)
                    <button type="button"
                            class="inline-flex items-center px-3 py-2 bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-lg font-medium text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200"
                            id="reorderBtn">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                        </svg>
                        Atur Urutan
                    </button>
                @endif
                <div class="relative inline-block text-left">
                    <button type="button"
                            class="inline-flex items-center px-3 py-2 bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-lg font-medium text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200"
                            onclick="toggleDropdown('actionsDropdown')">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Aksi
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="actionsDropdown" class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                        <div class="py-1">
                            <a href="#" onclick="exportData()" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Export Data
                            </a>
                            <a href="#" onclick="refreshData()" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Refresh
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6">
            @if($visiMisiItems->count() > 0)
                <!-- Desktop Table View -->
                <div class="hidden md:block overflow-hidden rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200" id="sortableTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">
                                    <svg class="w-4 h-4 text-gray-400 sortable-handle hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                    </svg>
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Konten</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($visiMisiItems as $index => $item)
                                <tr data-id="{{ $item->id }}" class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <svg class="w-4 h-4 text-gray-400 sortable-handle hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                        </svg>
                                        {{ $item->order_position ?: $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->title }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ strip_tags($item->content) }}">
                                            {!! Str::limit(strip_tags($item->content), 100) !!}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('dashboard.visi-misi.toggle-active', $item) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                    class="inline-flex items-center px-2.5 py-1.5 rounded-full text-xs font-medium transition-colors duration-200 {{ $item->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}"
                                                    title="{{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                @if($item->is_active)
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Aktif
                                                @else
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Nonaktif
                                                @endif
                                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('dashboard.visi-misi.show', $item) }}"
                                               class="inline-flex items-center p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors duration-200"
                                               title="Lihat">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('dashboard.visi-misi.edit', $item) }}"
                                               class="inline-flex items-center p-2 text-yellow-600 hover:text-yellow-800 hover:bg-yellow-50 rounded-lg transition-colors duration-200"
                                               title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <button type="button"
                                                    class="inline-flex items-center p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors duration-200"
                                                    onclick="confirmDelete({{ $item->id }}, '{{ $item->title }}')"
                                                    title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="md:hidden space-y-4">
                    @foreach($visiMisiItems as $index => $item)
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                            <div class="p-4">
                                <div class="flex justify-between items-start mb-3">
                                    <h4 class="text-lg font-medium text-gray-900 pr-4">{{ $item->title }}</h4>
                                    <div class="relative">
                                        <button type="button"
                                                class="inline-flex items-center p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg"
                                                onclick="toggleDropdown('mobileActions{{ $item->id }}')">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                            </svg>
                                        </button>
                                        <div id="mobileActions{{ $item->id }}" class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                                            <div class="py-1">
                                                <a href="{{ route('dashboard.visi-misi.show', $item) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                    Lihat
                                                </a>
                                                <a href="{{ route('dashboard.visi-misi.edit', $item) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    Edit
                                                </a>
                                                <hr class="my-1 border-gray-200">
                                                <button type="button" onclick="confirmDelete({{ $item->id }}, '{{ $item->title }}')" class="flex items-center w-full px-4 py-2 text-sm text-red-700 hover:bg-red-50">
                                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-sm text-gray-600 mb-3">
                                    {!! Str::limit(strip_tags($item->content), 120) !!}
                                </p>

                                <div class="flex justify-between items-center pt-3 border-t border-gray-200">
                                    <span class="text-xs text-gray-500">
                                        Urutan: {{ $item->order_position ?: $index + 1 }}
                                    </span>
                                    <form action="{{ route('dashboard.visi-misi.toggle-active', $item) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium transition-colors duration-200 {{ $item->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                                            @if($item->is_active)
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                                Aktif
                                            @else
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                </svg>
                                                Nonaktif
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($type === 'visi')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            @elseif($type === 'misi')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @endif
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data {{ $types[$type] ?? ucfirst($type) }}</h3>
                    <p class="text-gray-500 mb-6">Mulai dengan menambahkan data {{ $types[$type] ?? ucfirst($type) }} pertama Anda.</p>
                    <a href="{{ route('dashboard.visi-misi.create', ['type' => $type]) }}"
                       class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambah {{ $types[$type] ?? ucfirst($type) }}
                    </a>
                </div>
            @endif
        </div>
    </div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center" style="display: none;">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h3>
                <button type="button" onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="px-6 py-4">
            <p class="text-gray-700 mb-4">Apakah Anda yakin ingin menghapus <strong id="deleteItemName"></strong>?</p>
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-3 flex items-start space-x-3">
                <svg class="w-5 h-5 text-amber-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                <p class="text-amber-800 text-sm font-medium">Tindakan ini tidak dapat dibatalkan!</p>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
            <button type="button" onclick="closeDeleteModal()"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                Batal
            </button>
            <form id="deleteForm" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Reorder Modal -->
<div id="reorderModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center" style="display: none;">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Atur Urutan {{ $types[$type] ?? ucfirst($type) }}</h3>
                <button type="button" onclick="closeReorderModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="px-6 py-4">
            <p class="text-gray-600 mb-4">Seret item untuk mengubah urutan tampilan:</p>
            <div id="sortable-list" class="space-y-2">
                @foreach($visiMisiItems->sortBy('order_position') as $item)
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 flex items-center cursor-move hover:bg-gray-100 transition-colors" data-id="{{ $item->id }}">
                        <svg class="w-5 h-5 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V6a2 2 0 012-2h2M4 8v8a2 2 0 002 2h8a2 2 0 002-2V8M4 8h16m0 0V6a2 2 0 00-2-2h-2m2 2v8a2 2 0 01-2 2h-8a2 2 0 01-2-2V8"/>
                        </svg>
                        <div class="flex-grow">
                            <div class="font-medium text-gray-900">{{ $item->title }}</div>
                            <div class="text-sm text-gray-500 mt-1">{{ Str::limit(strip_tags($item->content), 60) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
            <button type="button" onclick="closeReorderModal()"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                Batal
            </button>
            <button type="button" onclick="saveOrder()"
                    class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 border border-transparent rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-colors">
                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                </svg>
                Simpan Urutan
            </button>
        </div>
    </div>
</div>



<script>
    // Modal functions
    function confirmDelete(id, name) {
        document.getElementById('deleteItemName').textContent = name;
        document.getElementById('deleteForm').action =
            '{{ route("dashboard.visi-misi.destroy", ":id") }}'.replace(':id', id);
        const modal = document.getElementById('deleteModal');
        modal.style.display = 'flex';
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.style.display = 'none';
    }

    function openReorderModal() {
        const modal = document.getElementById('reorderModal');
        modal.style.display = 'flex';
        initializeSortable();
    }

    function closeReorderModal() {
        const modal = document.getElementById('reorderModal');
        modal.style.display = 'none';
    }

    // Dropdown functionality
    function toggleDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        const isHidden = dropdown.classList.contains('hidden');

        // Find the button that triggered this dropdown
        const button = document.querySelector(`[onclick*="${dropdownId}"]`);

        // Close all dropdowns first and remove active states
        document.querySelectorAll('[id$="Dropdown"], [id^="mobileActions"]').forEach(d => {
            if (d.id !== dropdownId) {
                d.classList.add('hidden');
            }
        });

        // Remove active state from all dropdown buttons
        document.querySelectorAll('[onclick*="toggleDropdown"]').forEach(btn => {
            btn.classList.remove('bg-gray-200', 'ring-2', 'ring-gray-300');
            btn.classList.add('bg-gray-100');
        });

        // Toggle current dropdown
        if (isHidden) {
            dropdown.classList.remove('hidden');
            // Add active state to current button
            if (button) {
                button.classList.remove('bg-gray-100');
                button.classList.add('bg-gray-200', 'ring-2', 'ring-gray-300');
            }
        } else {
            dropdown.classList.add('hidden');
            // Remove active state from current button
            if (button) {
                button.classList.remove('bg-gray-200', 'ring-2', 'ring-gray-300');
                button.classList.add('bg-gray-100');
            }
        }
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        // Check if the clicked element is inside a dropdown button or dropdown menu
        const isDropdownButton = event.target.closest('[onclick*="toggleDropdown"]');
        const isInsideDropdown = event.target.closest('[id$="Dropdown"], [id^="mobileActions"]');

        if (!isDropdownButton && !isInsideDropdown) {
            document.querySelectorAll('[id$="Dropdown"], [id^="mobileActions"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });

    // Close dropdowns when pressing Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            document.querySelectorAll('[id$="Dropdown"], [id^="mobileActions"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });

    // Close dropdowns when clicking on links inside them
    document.addEventListener('click', function(event) {
        const clickedLink = event.target.closest('a');
        const clickedButton = event.target.closest('button[onclick*="confirmDelete"], button[onclick*="exportData"], button[onclick*="refreshData"]');

        if ((clickedLink || clickedButton) && event.target.closest('[id$="Dropdown"], [id^="mobileActions"]')) {
            // Small delay to allow navigation/action to complete
            setTimeout(() => {
                document.querySelectorAll('[id$="Dropdown"], [id^="mobileActions"]').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            }, 100);
        }
    });

    // Close modals when clicking outside
    document.addEventListener('click', function(event) {
        const deleteModal = document.getElementById('deleteModal');
        const reorderModal = document.getElementById('reorderModal');

        if (event.target === deleteModal) {
            closeDeleteModal();
        }
        if (event.target === reorderModal) {
            closeReorderModal();
        }
    });

    function exportData() {
        window.location.href = '{{ route("dashboard.visi-misi.index", ["type" => $type]) }}?export=1';
    }

    function refreshData() {
        location.reload();
    }

    // Sortable functionality using SortableJS
    let sortableInstance = null;

    function initializeSortable() {
        const sortableList = document.getElementById('sortable-list');
        if (sortableList && !sortableInstance) {
            sortableInstance = new Sortable(sortableList, {
                animation: 150,
                ghostClass: 'opacity-50',
                handle: 'svg',
                onUpdate: function() {
                    // Visual feedback that order has changed
                    document.querySelector('[onclick="saveOrder()"]').classList.add('bg-amber-600', 'hover:bg-amber-700');
                    document.querySelector('[onclick="saveOrder()"]').classList.remove('bg-emerald-600', 'hover:bg-emerald-700');
                }
            });
        }
    }

    function saveOrder() {
        const itemIds = [];
        document.querySelectorAll('#sortable-list [data-id]').forEach(function(item) {
            itemIds.push(parseInt(item.dataset.id));
        });

        const saveButton = document.querySelector('[onclick="saveOrder()"]');
        const originalText = saveButton.innerHTML;
        saveButton.innerHTML = '<svg class="w-4 h-4 inline-block mr-1 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>Menyimpan...';
        saveButton.disabled = true;

        fetch('{{ route("dashboard.visi-misi.reorder") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                type: '{{ $type }}',
                item_ids: itemIds
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success || response.ok) {
                location.reload();
            } else {
                alert('Gagal menyimpan urutan');
                saveButton.innerHTML = originalText;
                saveButton.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan');
            saveButton.innerHTML = originalText;
            saveButton.disabled = false;
        });
    }

    // Update reorder button click handler
    document.addEventListener('DOMContentLoaded', function() {
        const reorderBtn = document.getElementById('reorderBtn');
        if (reorderBtn) {
            reorderBtn.addEventListener('click', openReorderModal);
        }
    });
</script>

<!-- Include SortableJS from CDN -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

        </div>
    </div>
</x-app-layout>
