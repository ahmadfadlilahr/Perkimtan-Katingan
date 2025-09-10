{{-- resources/views/components/logo.blade.php --}}
@props(['size' => 'default', 'class' => ''])

@php
    $sizeClasses = [
        'small' => 'h-8',
        'default' => 'h-10',
        'large' => 'h-12'
    ];

    $logoHeight = $sizeClasses[$size] ?? $sizeClasses['default'];
@endphp

<div class="flex items-center space-x-3 {{ $class }}">
    {{-- Logo Image Container --}}
    <div class="flex-shrink-0">
        {{-- Logo Dinas Asli --}}
        <img src="{{ asset('images/logo-dinas.png') }}"
             alt="Logo Dinas Perumahan dan Permukiman"
             class="{{ $logoHeight }} w-auto object-contain">
    </div>

    {{-- Text Logo --}}
    <div class="flex flex-col">
        <div class="font-bold text-gray-800 {{ $logoHeight === 'h-8' ? 'text-sm' : ($logoHeight === 'h-10' ? 'text-lg' : 'text-xl') }} leading-tight">
            Dinas Perkim
        </div>
        @if($size !== 'small')
            <div class="text-xs text-gray-600 leading-tight">
                Perumahan, Kawasan Permukiman dan Pertanahan
            </div>
        @endif
    </div>
</div>
