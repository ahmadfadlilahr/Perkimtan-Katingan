@props([
    'variant' => 'primary', // primary, secondary, success, warning, danger, info
    'size' => 'md', // sm, md, lg
    'dot' => false,
    'rounded' => 'full' // none, sm, md, lg, full
])

@php
$variantClasses = [
    'primary' => 'bg-indigo-100 text-indigo-800 border border-indigo-200',
    'secondary' => 'bg-gray-100 text-gray-800 border border-gray-200',
    'success' => 'bg-emerald-100 text-emerald-800 border border-emerald-200',
    'warning' => 'bg-amber-100 text-amber-800 border border-amber-200',
    'danger' => 'bg-red-100 text-red-800 border border-red-200',
    'info' => 'bg-cyan-100 text-cyan-800 border border-cyan-200'
];

$sizeClasses = [
    'sm' => 'px-2 py-1 text-xs',
    'md' => 'px-3 py-1 text-sm',
    'lg' => 'px-4 py-2 text-base'
];

$roundedClasses = [
    'none' => 'rounded-none',
    'sm' => 'rounded-sm',
    'md' => 'rounded-md',
    'lg' => 'rounded-lg',
    'full' => 'rounded-full'
];

$classes = trim(implode(' ', [
    'inline-flex items-center font-medium',
    $variantClasses[$variant] ?? $variantClasses['primary'],
    $sizeClasses[$size] ?? $sizeClasses['md'],
    $roundedClasses[$rounded] ?? $roundedClasses['full'],
    $attributes->get('class', '')
]));

$dotColor = match($variant) {
    'success' => 'bg-emerald-500',
    'warning' => 'bg-amber-500',
    'danger' => 'bg-red-500',
    'info' => 'bg-cyan-500',
    'secondary' => 'bg-gray-500',
    default => 'bg-indigo-500'
};
@endphp

<span {{ $attributes->class($classes) }}>
    @if($dot)
        <span class="w-1.5 h-1.5 {{ $dotColor }} rounded-full mr-2"></span>
    @endif
    {{ $slot }}
</span>
