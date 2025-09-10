@props([
    'name',
    'type' => 'text',
    'placeholder' => '',
    'required' => 'false',
    'rows' => null,
    'options' => null,
    'value' => '',
    'label' => '',
    'id' => null,
    'min' => null,
    'max' => null,
    'accept' => null
])

@php
    $id = $id ?? $name;
    $isRequired = $required === 'true' || $required === true;
    $hasError = $errors->has($name);
    $baseClasses = 'w-full rounded-lg shadow-sm';
    $normalClasses = 'border-gray-300 focus:border-emerald-500 focus:ring-emerald-500';
    $errorClasses = 'border-red-300 focus:border-red-500 focus:ring-red-500';
    $inputClasses = $hasError ? "{$baseClasses} {$errorClasses}" : "{$baseClasses} {$normalClasses}";
    $oldValue = old($name, $value);
@endphp

<div>
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 mb-2">
            {{ $label }}
            @if($isRequired)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    @if($type === 'textarea')
        <textarea
            id="{{ $id }}"
            name="{{ $name }}"
            rows="{{ $rows ?? 4 }}"
            placeholder="{{ $placeholder }}"
            class="{{ $inputClasses }}"
            @if($isRequired) required @endif
            {{ $attributes->except(['class']) }}
        >{{ $oldValue }}</textarea>

    @elseif($type === 'select')
        <select
            id="{{ $id }}"
            name="{{ $name }}"
            class="{{ $inputClasses }}"
            @if($isRequired) required @endif
            {{ $attributes->except(['class']) }}
        >
            @if($options)
                @foreach($options as $optionValue => $optionLabel)
                    <option value="{{ $optionValue }}" {{ $oldValue == $optionValue ? 'selected' : '' }}>
                        {{ $optionLabel }}
                    </option>
                @endforeach
            @endif
            {{ $slot }}
        </select>

    @elseif($type === 'file')
        <input
            type="file"
            id="{{ $id }}"
            name="{{ $name }}"
            class="{{ $inputClasses }} file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100"
            @if($isRequired) required @endif
            @if($accept) accept="{{ $accept }}" @endif
            {{ $attributes->except(['class']) }}
        />

    @else
        <input
            type="{{ $type }}"
            id="{{ $id }}"
            name="{{ $name }}"
            value="{{ $oldValue }}"
            placeholder="{{ $placeholder }}"
            class="{{ $inputClasses }}"
            @if($isRequired) required @endif
            @if($min) min="{{ $min }}" @endif
            @if($max) max="{{ $max }}" @endif
            {{ $attributes->except(['class']) }}
        />
    @endif

    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
