{{-- resources/views/components/ui/alert.blade.php --}}
@props(['type' => 'success', 'message'])

@php
    $alertClasses = [
        'success' => 'bg-green-50 border border-green-200 text-green-800',
        'error' => 'bg-red-50 border border-red-200 text-red-800',
        'warning' => 'bg-yellow-50 border border-yellow-200 text-yellow-800',
        'info' => 'bg-blue-50 border border-blue-200 text-blue-800',
    ];

    $iconSvg = [
        'success' => '<svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        'error' => '<svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        'warning' => '<svg class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>',
        'info' => '<svg class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
    ];
@endphp

<div class="mb-6 p-4 rounded-lg {{ $alertClasses[$type] }} flex items-start space-x-3" role="alert">
    <div class="flex-shrink-0 mt-0.5">
        {!! $iconSvg[$type] !!}
    </div>
    <div class="flex-1">
        <p class="text-sm font-medium">{{ $message }}</p>
    </div>
</div>
