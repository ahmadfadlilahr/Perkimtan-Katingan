<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-900">
                Dashboard
            </h2>
        </div>
    </x-slot>

    <div class="p-6">
        {{-- Welcome Card --}}
        <div class="mb-8">
            <x-admin.welcome-card :user="Auth::user()" />
        </div>

        {{-- Statistics Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <x-admin.stat-card
                title="Total Berita"
                :value="$totalBerita"
                color="blue"
                href="{{ route('dashboard.berita.index') }}"
                icon="news" />

            <x-admin.stat-card
                title="Total Agenda"
                :value="$totalAgenda"
                color="green"
                href="{{ route('dashboard.agenda.index') }}"
                icon="calendar" />

            <x-admin.stat-card
                title="Total Pejabat"
                :value="$totalPejabat"
                color="indigo"
                href="{{ route('dashboard.pejabat.index') }}"
                icon="users" />

            <x-admin.stat-card
                title="Pesan Belum Dibaca"
                :value="$pesanBelumDibaca"
                color="yellow"
                href="{{ route('dashboard.pesan.index') }}"
                icon="mail" />
        </div>

        {{-- Quick Actions or Additional Content --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
            {{-- Recent Activity Card --}}
            <div class="bg-white rounded-lg border border-gray-200 p-6 h-full">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div class="space-y-3">
                    @can('kelola berita')
                    <a href="{{ route('dashboard.berita.create') }}"
                       class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors group">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-200 transition-colors">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900">Buat Berita Baru</div>
                            <div class="text-sm text-gray-500">Tambah artikel berita terbaru</div>
                        </div>
                    </a>
                    @endcan

                    @can('kelola galeri')
                    <a href="{{ route('dashboard.galeri.create') }}"
                       class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors group">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-green-200 transition-colors">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900">Upload Foto Galeri</div>
                            <div class="text-sm text-gray-500">Tambah foto ke galeri</div>
                        </div>
                    </a>
                    @endcan
                </div>
            </div>

            {{-- System Info Card --}}
            <div class="bg-white rounded-lg border border-gray-200 p-6 h-full">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Riwayat Histori</h3>
                    <div class="flex items-center space-x-2">
                        <!-- Cleanup Info Badge -->
                        @if(isset($logsStats) && $needsCleanup)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                {{ $logsStats['old_logs'] }} log lama
                            </span>
                        @endif

                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Activity Logs Stats -->
                @if(isset($logsStats))
                <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ $logsStats['total_logs'] }}</div>
                            <div class="text-xs text-gray-500">Total Log</div>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-green-600">{{ $logsStats['recent_logs'] }}</div>
                            <div class="text-xs text-gray-500">30 Hari Terakhir</div>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-yellow-600">{{ $logsStats['old_logs'] }}</div>
                            <div class="text-xs text-gray-500">Lebih dari 30 Hari</div>
                        </div>
                    </div>
                </div>
                @else
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                    <div class="text-sm text-red-600">Error loading activity logs statistics</div>
                </div>
                @endif

                <!-- Cleanup Actions -->
                @if(isset($needsCleanup) && $needsCleanup && isset($logsStats))
                    <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-yellow-400 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.232 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-yellow-800">Cleanup Disarankan</h4>
                                <p class="text-xs text-yellow-700 mt-1">
                                    Ada {{ $logsStats['old_logs'] }} log aktivitas yang lebih lama dari 30 hari.
                                    <br>Cleanup secara otomatis berjalan setiap hari pukul 02:00.
                                </p>
                                <div class="mt-2">
                                    <button onclick="showCleanupModal()" class="inline-flex items-center px-3 py-1 border border-yellow-300 text-xs font-medium rounded text-yellow-700 bg-yellow-100 hover:bg-yellow-200 transition-colors">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Cleanup Manual
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Recent Activity Logs -->@if($recentActivities->count() > 0)
                    <div class="space-y-2 max-h-64 overflow-y-auto pr-2" style="scrollbar-width: thin; scrollbar-color: #d1d5db #f9fafb;">
                        @foreach($recentActivities as $activity)
                            <div class="flex items-start space-x-3 p-2.5 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors">
                                <div class="flex-shrink-0">
                                    <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs
                                        {{ $activity->color === 'green' ? 'bg-green-100 text-green-600' : '' }}
                                        {{ $activity->color === 'blue' ? 'bg-blue-100 text-blue-600' : '' }}
                                        {{ $activity->color === 'red' ? 'bg-red-100 text-red-600' : '' }}
                                        {{ $activity->color === 'yellow' ? 'bg-yellow-100 text-yellow-600' : '' }}
                                        {{ $activity->color === 'emerald' ? 'bg-emerald-100 text-emerald-600' : '' }}
                                        {{ $activity->color === 'indigo' ? 'bg-indigo-100 text-indigo-600' : '' }}
                                        {{ $activity->color === 'gray' ? 'bg-gray-100 text-gray-600' : '' }}">
                                        {{ $activity->icon }}
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-medium text-gray-900 line-clamp-2">
                                        {{ $activity->description }}
                                    </p>
                                    <div class="flex items-center text-xs text-gray-500 mt-1">
                                        <span class="truncate">{{ $activity->user ? $activity->user->name : 'System' }}</span>
                                        <span class="mx-1">•</span>
                                        <span class="whitespace-nowrap">{{ $activity->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-500">Belum ada aktivitas yang tercatat</p>
                        <p class="text-xs text-gray-400 mt-1">Aktivitas admin akan muncul di sini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Cleanup Modal -->
    <div id="cleanupModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Cleanup Activity Logs</h3>
                    <button onclick="hideCleanupModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="mb-4">
                    <label for="cleanupDays" class="block text-sm font-medium text-gray-700 mb-2">
                        Hapus log yang lebih lama dari:
                    </label>
                    <select id="cleanupDays" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="30">30 hari (1 bulan)</option>
                        <option value="60">60 hari (2 bulan)</option>
                        <option value="90">90 hari (3 bulan)</option>
                        <option value="180">180 hari (6 bulan)</option>
                    </select>
                </div>

                <div class="bg-yellow-50 border border-yellow-200 rounded-md p-3 mb-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-yellow-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.232 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <div class="text-sm">
                            <p class="text-yellow-800 font-medium">Peringatan</p>
                            <p class="text-yellow-700">Log yang dihapus tidak dapat dikembalikan. Pastikan Anda yakin dengan pilihan ini.</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-3">
                    <button onclick="hideCleanupModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 transition-colors">
                        Batal
                    </button>
                    <button onclick="performCleanup()" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 transition-colors">
                        Hapus Log
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <style>
        /* Custom scrollbar for activity logs */
        .space-y-2::-webkit-scrollbar {
            width: 4px;
        }
        .space-y-2::-webkit-scrollbar-track {
            background: #f9fafb;
            border-radius: 2px;
        }
        .space-y-2::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 2px;
        }
        .space-y-2::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }

        /* Line clamp utility for text truncation */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Ensure grid doesn't break on smaller screens */
        .grid.grid-cols-1.lg\\:grid-cols-2 {
            height: auto;
        }

        /* Fixed height for consistency */
        .bg-white.rounded-lg.border.border-gray-200.p-6 {
            height: fit-content;
            max-height: 500px;
        }
    </style>
    <script>
        function showCleanupModal() {
            document.getElementById('cleanupModal').classList.remove('hidden');
        }

        function hideCleanupModal() {
            document.getElementById('cleanupModal').classList.add('hidden');
        }

        async function performCleanup() {
            const days = document.getElementById('cleanupDays').value;
            const button = event.target;
            const originalText = button.textContent;

            // Show loading state
            button.disabled = true;
            button.textContent = 'Menghapus...';

            try {
                const response = await fetch('{{ route("dashboard.activity.cleanup") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ days: parseInt(days) })
                });

                const result = await response.json();

                if (result.success) {
                    hideCleanupModal();

                    // Show success notification
                    showNotification('success', `Berhasil menghapus ${result.deleted_count} log aktivitas`);

                    // Reload page after short delay
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showNotification('error', result.message || 'Gagal melakukan cleanup');
                }
            } catch (error) {
                console.error('Cleanup error:', error);
                showNotification('error', 'Terjadi kesalahan saat melakukan cleanup');
            } finally {
                button.disabled = false;
                button.textContent = originalText;
            }
        }

        function showNotification(type, message) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-md shadow-lg ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Close modal when clicking outside
        document.getElementById('cleanupModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideCleanupModal();
            }
        });
    </script>
    @endpush
</x-app-layout>
