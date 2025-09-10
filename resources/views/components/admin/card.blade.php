{{-- resources/views/components/admin/card.blade.php --}}
@props(['class' => ''])

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-gray-200 ' . $class]) }}>
    @isset($header)
        <div class="px-6 py-4 border-b border-gray-100">
            {{ $header }}
        </div>
    @endisset

    <div class="p-6">
        {{ $slot }}
    </div>
</div>
