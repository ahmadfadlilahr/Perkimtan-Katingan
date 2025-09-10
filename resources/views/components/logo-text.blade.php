{{-- resources/views/components/logo-text.blade.php --}}
@props(['size' => 'default', 'class' => '', 'showSubtext' => true])

@php
    $sizeClasses = [
        'small' => [
            'text' => 'text-sm',
            'subtext' => 'text-xs'
        ],
        'default' => [
            'text' => 'text-lg',
            'subtext' => 'text-xs'
        ],
        'large' => [
            'text' => 'text-xl',
            'subtext' => 'text-sm'
        ],
        'hero' => [
            'text' => 'text-3xl',
            'subtext' => 'text-base'
        ]
    ];

    $currentSize = $sizeClasses[$size] ?? $sizeClasses['default'];
@endphp

<div class="flex flex-col {{ $class }}">
    <div class="font-bold text-gray-800 {{ $currentSize['text'] }} leading-tight">
        Dinas Perkim
    </div>
    @if($showSubtext && $size !== 'small')
        <div class="{{ $currentSize['subtext'] }} text-gray-600 leading-tight">
            Pekerjaan Umum & Perumahan
        </div>
    @endif
</div>
