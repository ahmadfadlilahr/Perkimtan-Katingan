{{-- resources/views/components/admin/stat-card.blade.php --}}
@props([
    'title' => '',
    'value' => '0',
    'color' => 'gray',
    'icon' => null,
    'href' => null
])

@php
    $colorClasses = [
        'gray' => 'bg-white border-gray-200 text-gray-600',
        'blue' => 'bg-blue-50 border-blue-200 text-blue-600',
        'green' => 'bg-green-50 border-green-200 text-green-600',
        'yellow' => 'bg-yellow-50 border-yellow-200 text-yellow-600',
        'red' => 'bg-red-50 border-red-200 text-red-600',
        'indigo' => 'bg-indigo-50 border-indigo-200 text-indigo-600'
    ];

    $cardClass = $colorClasses[$color] ?? $colorClasses['gray'];
    $valueColorClass = match($color) {
        'gray' => 'text-gray-900',
        'blue' => 'text-blue-700',
        'green' => 'text-green-700',
        'yellow' => 'text-yellow-700',
        'red' => 'text-red-700',
        'indigo' => 'text-indigo-700',
        default => 'text-gray-900'
    };

    $iconColorClass = match($color) {
        'gray' => 'text-gray-600',
        'blue' => 'text-blue-600',
        'green' => 'text-green-600',
        'yellow' => 'text-yellow-600',
        'red' => 'text-red-600',
        'indigo' => 'text-indigo-600',
        default => 'text-gray-600'
    };

    $iconBgClass = match($color) {
        'gray' => 'bg-gray-100',
        'blue' => 'bg-blue-100',
        'green' => 'bg-green-100',
        'yellow' => 'bg-yellow-100',
        'red' => 'bg-red-100',
        'indigo' => 'bg-indigo-100',
        default => 'bg-gray-100'
    };

    // Icon SVG definitions
    $icons = [
        'news' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path></svg>',
        'page' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>',
        'users' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>',
        'mail' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>',
        'history' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
    ];
@endphp

<div class="group {{ $href ? 'cursor-pointer' : '' }}" @if($href) onclick="window.location.href='{{ $href }}'" @endif>
    <div class="{{ $cardClass }} border rounded-lg p-6 transition-all duration-200 hover:shadow-md {{ $href ? 'hover:scale-[1.02]' : '' }}">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <h3 class="text-sm font-medium {{ str_replace('bg-', 'text-', str_replace('-50', '-600', explode(' ', $cardClass)[0])) }}">
                    {{ $title }}
                </h3>
                <p class="text-3xl font-bold {{ $valueColorClass }} mt-2">
                    {{ number_format($value) }}
                </p>
            </div>

            @if($icon && isset($icons[$icon]))
                <div class="flex-shrink-0 ml-4">
                    <div class="w-12 h-12 {{ $iconBgClass }} rounded-lg flex items-center justify-center {{ $iconColorClass }}">
                        {!! $icons[$icon] !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
