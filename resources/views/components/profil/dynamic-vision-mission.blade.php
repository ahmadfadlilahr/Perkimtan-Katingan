@props([
    'visiItems' => collect(),
    'misiItems' => collect()
])

{{-- Vision & Mission Cards --}}
<div class="bg-white py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Visi Card --}}
            @if($visiItems->count() > 0)
                @foreach($visiItems as $visi)
                    <x-profil.vision-mission-card
                        title="Visi"
                        bgColor="bg-gradient-to-br from-indigo-50 to-blue-50"
                        iconBgColor="bg-indigo-100"
                        iconColor="text-indigo-600">

                        <x-slot name="icon">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </x-slot>

                        <x-slot name="content">
                            <p class="text-lg leading-relaxed text-gray-700 font-medium">
                                "{{ $visi->content }}"
                            </p>
                        </x-slot>
                    </x-profil.vision-mission-card>
                    @break {{-- Only show first visi --}}
                @endforeach
            @else
                {{-- Notice: No active visi found --}}
                <div class="bg-gradient-to-br from-indigo-50 to-blue-50 rounded-xl p-6 border border-indigo-100">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-indigo-100 rounded-full mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-indigo-900 mb-2">Visi</h3>
                        <p class="text-sm text-indigo-600 mb-3 italic">Belum ada visi yang aktif dipublikasikan</p>
                        <div class="bg-white/50 rounded-lg p-4">
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Visi sedang dalam tahap peninjauan dan akan segera dipublikasikan.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Misi Card --}}
            <x-profil.vision-mission-card
                title="Misi"
                bgColor="bg-gradient-to-br from-green-50 to-emerald-50"
                iconBgColor="bg-green-100"
                iconColor="text-green-600">

                <x-slot name="icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </x-slot>

                <x-slot name="content">
                    @if($misiItems->count() > 0)
                        <ul class="space-y-3 text-gray-700 list-disc pl-6">
                            @foreach($misiItems as $misi)
                                <li>{{ $misi->content }}</li>
                            @endforeach
                        </ul>
                    @else
                        {{-- Notice: No active misi found --}}
                        <div class="text-center py-6">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-green-100 rounded-full mb-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            </div>
                            <p class="text-sm text-green-600 italic">Belum ada misi yang aktif dipublikasikan</p>
                            <div class="bg-white/50 rounded-lg p-3 mt-2">
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Misi sedang dalam tahap peninjauan dan akan segera dipublikasikan.
                                </p>
                            </div>
                        </div>
                    @endif
                </x-slot>
            </x-profil.vision-mission-card>
        </div>
    </div>
</div>
