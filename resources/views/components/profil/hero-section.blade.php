{{-- resources/views/components/profil/hero-section.blade.php --}}
@props([
    'title',
    'subtitle' => null,
    'backgroundImage' => null,
    'showOverlay' => true
])

<div class="relative bg-gradient-to-br from-gray-50 via-gray-100 to-gray-200 py-16 sm:py-24">
    {{-- Background Image (Optional) --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img class="h-full w-full object-cover" src="{{ $backgroundImage }}" alt="">
            @if($showOverlay)
                <div class="absolute inset-0 bg-gray-100 bg-opacity-75"></div>
            @endif
        </div>
    @endif

    {{-- Background Pattern --}}
    <div class="absolute inset-0">
        <svg class="absolute inset-0 h-full w-full" preserveAspectRatio="xMidYMid slice">
            <defs>
                <pattern id="hero-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <circle cx="20" cy="20" r="1.5" fill="rgba(107,114,128,0.1)"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#hero-pattern)"/>
        </svg>
    </div>

    <div class="relative mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-4xl text-center">
            {{-- Title --}}
            <h1 class="text-4xl font-bold tracking-tight text-gray-800 sm:text-5xl lg:text-6xl">
                {{ $title }}
            </h1>

            {{-- Subtitle --}}
            @if($subtitle)
                <p class="mt-6 text-xl leading-8 text-gray-600">
                    {{ $subtitle }}
                </p>
            @endif

            {{-- Decorative Element --}}
            <div class="mt-8 flex justify-center">
                <div class="h-1 w-20 bg-gray-400 rounded-full opacity-60"></div>
            </div>
        </div>
    </div>
</div>
