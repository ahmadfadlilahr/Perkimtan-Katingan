{{-- resources/views/components/ui/form-textarea.blade.php --}}
@props(['name', 'label', 'rows' => 4, 'required' => false, 'placeholder' => '', 'value' => ''])

<div>
    <label for="{{ $name }}" class="block text-sm font-semibold leading-6 text-gray-900 mb-2">
        {{ $label }}
        @if($required)
            <span class="text-red-500 ml-1">*</span>
        @endif
    </label>
    <div class="relative">
        <textarea name="{{ $name }}"
                  id="{{ $name }}"
                  rows="{{ $rows }}"
                  placeholder="{{ $placeholder }}"
                  {{ $required ? 'required' : '' }}
                  class="block w-full rounded-lg border-0 px-4 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 transition-colors duration-200 hover:ring-gray-400 resize-none {{ $attributes->get('class') }}">{{ old($name, $value) }}</textarea>
        @error($name)
            <div class="absolute top-3 right-3">
                <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        @enderror
    </div>
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
