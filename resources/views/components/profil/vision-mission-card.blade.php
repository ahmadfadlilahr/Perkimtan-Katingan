{{-- resources/views/components/profil/vision-mission-card.blade.php --}}
@props([
    'title',
    'content',
    'icon',
    'bgColor' => 'bg-white',
    'iconBgColor' => 'bg-indigo-100',
    'iconColor' => 'text-indigo-600'
])

<div class="{{ $bgColor }} rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
    {{-- Header with Icon --}}
    <div class="flex items-center mb-6">
        <div class="w-12 h-12 {{ $iconBgColor }} rounded-xl flex items-center justify-center mr-4">
            <div class="{{ $iconColor }}">
                {!! $icon !!}
            </div>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $title }}</h3>
    </div>

    {{-- Content --}}
    <div class="prose prose-gray max-w-none">
        {!! $content !!}
    </div>
</div>
