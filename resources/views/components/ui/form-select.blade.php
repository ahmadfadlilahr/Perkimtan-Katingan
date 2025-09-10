{{-- resources/views/components/ui/form-select.blade.php --}}
@props(['name', 'label', 'options' => [], 'required' => false, 'placeholder' => 'Pilih...', 'selected' => ''])

<div>
    <label for="{{ $name }}" class="block text-sm font-semibold leading-6 text-gray-900 mb-2">
        {{ $label }}
        @if($required)
            <span class="text-red-500 ml-1">*</span>
        @endif
    </label>
    <div class="relative">
        <select name="{{ $name }}"
                id="{{ $name }}"
                {{ $required ? 'required' : '' }}
                class="block w-full rounded-lg border-0 px-4 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 transition-colors duration-200 hover:ring-gray-400 {{ $attributes->get('class') }}">
            @if($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif
            @if(is_array($options) && count($options) > 0)
                @foreach($options as $value => $label)
                    <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            @else
                {{ $slot }}
            @endif
        </select>
        @error($name)
            <div class="absolute inset-y-0 right-8 flex items-center pr-3">
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
