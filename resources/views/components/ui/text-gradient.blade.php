@props([
    'variant' => 'primary', // primary, secondary, accent
    'size' => 'lg', // sm, md, lg, xl, 2xl
    'as' => 'span'
])

@php
$gradientClasses = [
    'primary' => 'bg-gradient-to-r from-indigo-600 via-blue-600 to-purple-600',
    'secondary' => 'bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600',
    'accent' => 'bg-gradient-to-r from-pink-600 via-rose-600 to-orange-600'
];

$sizeClasses = [
    'sm' => 'text-sm',
    'md' => 'text-base',
    'lg' => 'text-lg',
    'xl' => 'text-xl',
    '2xl' => 'text-2xl'
];

$classes = trim(implode(' ', [
    $gradientClasses[$variant] ?? $gradientClasses['primary'],
    $sizeClasses[$size] ?? $sizeClasses['lg'],
    'bg-clip-text text-transparent font-bold',
    $attributes->get('class', '')
]));
@endphp

@if($as === 'h1')
    <h1 {{ $attributes->class($classes) }}>
        {{ $slot }}
    </h1>
@elseif($as === 'h2')
    <h2 {{ $attributes->class($classes) }}>
        {{ $slot }}
    </h2>
@elseif($as === 'h3')
    <h3 {{ $attributes->class($classes) }}>
        {{ $slot }}
    </h3>
@elseif($as === 'p')
    <p {{ $attributes->class($classes) }}>
        {{ $slot }}
    </p>
@else
    <span {{ $attributes->class($classes) }}>
        {{ $slot }}
    </span>
@endif
