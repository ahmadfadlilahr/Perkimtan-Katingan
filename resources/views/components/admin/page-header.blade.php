{{-- resources/views/components/admin/page-header.blade.php --}}
@props([
    'title' => '',
    'subtitle' => '',
    'breadcrumbs' => [],
    'actions' => null
])

<div class="bg-white border-b border-gray-200">
    <div class="px-6 py-6">
        {{-- Breadcrumbs --}}
        @if(count($breadcrumbs) > 0)
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    @foreach($breadcrumbs as $index => $breadcrumb)
                        <li class="inline-flex items-center">
                            @if($index > 0)
                                <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            @endif
                            @if(isset($breadcrumb['href']) && $index < count($breadcrumbs) - 1)
                                <a href="{{ $breadcrumb['href'] }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
                                    {{ $breadcrumb['title'] }}
                                </a>
                            @else
                                <span class="text-sm font-medium text-gray-900">{{ $breadcrumb['title'] }}</span>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        @endif

        {{-- Header dengan Title dan Actions --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $title }}</h1>
                @if($subtitle)
                    <p class="mt-1 text-sm text-gray-600">{{ $subtitle }}</p>
                @endif
            </div>

            @if($actions)
                <div class="flex items-center space-x-3">
                    {{ $actions }}
                </div>
            @endif
        </div>
    </div>
</div>
