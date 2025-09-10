{{-- resources/views/components/admin/sidebar-link.blade.php --}}
@props([
    'active' => false,
    'href' => '#',
    'icon' => null,
    'badge' => null,
    'mobile' => false
])

@php
    $classes = $active
        ? 'bg-gradient-to-r from-blue-50 to-blue-100 border-blue-200 text-blue-700 font-semibold shadow-sm'
        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 border-transparent';

    $paddingClass = $mobile ? 'px-3 py-2' : 'px-3 py-3';
    $textSize = $mobile ? 'text-sm' : 'text-sm';
    $iconMargin = $mobile ? 'mr-2' : 'mr-3';
@endphp

<a href="{{ $href }}"
   class="flex items-center justify-between {{ $paddingClass }} {{ $textSize }} rounded-xl border transition-all duration-200 {{ $classes }} group"
   @if($mobile) @click="sidebarOpen = false" @endif>
    <div class="flex items-center">
        @if($icon)
            <div class="flex-shrink-0 {{ $iconMargin }} {{ $active ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                {!! $icon !!}
            </div>
        @endif
        <span class="font-medium">{{ $slot }}</span>
    </div>

    @if($badge && $badge > 0)
        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-gradient-to-r from-red-500 to-red-600 rounded-full shadow-sm">
            {{ $badge > 99 ? '99+' : $badge }}
        </span>
    @endif
</a>
