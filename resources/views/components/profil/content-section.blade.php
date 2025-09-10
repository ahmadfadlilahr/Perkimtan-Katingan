{{-- resources/views/components/profil/content-section.blade.php --}}
@props([
    'title' => null,
    'icon' => null,
    'containerClass' => 'py-16 sm:py-20',
    'maxWidth' => 'max-w-4xl'
])

<div class="bg-white {{ $containerClass }}">
    <div class="mx-auto {{ $maxWidth }} px-6 lg:px-8">
        {{-- Section Title --}}
        @if($title)
            <div class="text-center mb-12">
                <div class="flex items-center justify-center mb-4">
                    @if($icon)
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mr-4">
                            {!! $icon !!}
                        </div>
                    @endif
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                        {{ $title }}
                    </h2>
                </div>
                <div class="w-20 h-1 bg-indigo-600 rounded-full mx-auto"></div>
            </div>
        @endif

        {{-- Content --}}
        <div class="prose prose-lg max-w-none prose-indigo">
            {{ $slot }}
        </div>
    </div>
</div>
