@props(['type', 'value'])

@php
$badgeClasses = match($type) {
    'kategori' => match($value) {
        'rapat' => 'bg-blue-100 text-blue-800',
        'sosialisasi' => 'bg-purple-100 text-purple-800',
        'workshop' => 'bg-green-100 text-green-800',
        'acara_publik' => 'bg-orange-100 text-orange-800',
        default => 'bg-gray-100 text-gray-800'
    },
    'status' => match($value) {
        'draft' => 'bg-gray-100 text-gray-800',
        'published' => 'bg-emerald-100 text-emerald-800',
        'selesai' => 'bg-blue-100 text-blue-800',
        'dibatalkan' => 'bg-red-100 text-red-800',
        default => 'bg-slate-100 text-slate-800'
    },
    'prioritas' => match($value) {
        'tinggi' => 'bg-red-100 text-red-800',
        'sedang' => 'bg-yellow-100 text-yellow-800',
        'rendah' => 'bg-green-100 text-green-800',
        'mendesak' => 'bg-red-500 text-white',
        default => 'bg-neutral-100 text-neutral-800'
    },
    default => 'bg-gray-100 text-gray-800'
};
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {$badgeClasses}"]) }}>
    {{ $slot }}
</span>
