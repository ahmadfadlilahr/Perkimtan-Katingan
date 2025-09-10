{{-- resources/views/components/profil/stats-grid.blade.php --}}
@props([
    'stats' => []
])

<div class="bg-indigo-50 py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center mb-12">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                Dinas Perkim dalam Angka
            </h2>
            <p class="mt-4 text-lg leading-8 text-gray-600">
                Pencapaian dan kontribusi kami untuk masyarakat
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($stats as $stat)
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="text-center">
                        @if(isset($stat['icon']))
                            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                                {!! $stat['icon'] !!}
                            </div>
                        @endif

                        <div class="text-3xl font-bold text-indigo-600 mb-2">
                            {{ $stat['number'] }}
                        </div>

                        <div class="text-sm font-medium text-gray-900 mb-1">
                            {{ $stat['label'] }}
                        </div>

                        @if(isset($stat['description']))
                            <div class="text-xs text-gray-500">
                                {{ $stat['description'] }}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
