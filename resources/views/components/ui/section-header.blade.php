@props([
    'title' => '',
    'subtitle' => '',
    'centered' => true,
    'badge' => '',
    'badgeVariant' => 'primary',
    'animated' => false
])

<div {{ $attributes->class(['mb-12', 'text-center' => $centered, 'text-left' => !$centered]) }}>
    @if($badge)
        <div class="mb-4">
            <x-ui.badge :variant="$badgeVariant" class="{{ $animated ? 'animate-pulse' : '' }}">
                {{ $badge }}
            </x-ui.badge>
        </div>
    @endif

    @if($title)
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl {{ $animated ? 'animate-fade-in-up' : '' }}">
            {{ $title }}
        </h2>
    @endif

    @if($subtitle)
        <p class="mt-4 text-lg leading-8 text-gray-600 max-w-3xl {{ $centered ? 'mx-auto' : '' }} {{ $animated ? 'animate-fade-in-up animation-delay-200' : '' }}">
            {{ $subtitle }}
        </p>
    @endif

    {{ $slot }}
</div>
