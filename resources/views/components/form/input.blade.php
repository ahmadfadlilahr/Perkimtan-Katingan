@props([
    'name',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'rows' => null,
    'options' => null,
    'value' => '',
    'label' => '',
    'id' => null
])

@php
    $id = $id ?? $name;
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
            @if($required)
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
            @if($required) required @endif
            {{ $attributes }}
        >{{ $oldValue }}</textarea>

    @elseif($type === 'select')
        <select
            id="{{ $id }}"
            name="{{ $name }}"
            class="{{ $inputClasses }}"
            @if($required) required @endif
            {{ $attributes }}
        >
            @if($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif
            @if($options)
                @foreach($options as $optionValue => $optionLabel)
                    <option value="{{ $optionValue }}" {{ $oldValue == $optionValue ? 'selected' : '' }}>
                        {{ $optionLabel }}
                    </option>
                @endforeach
            @endif
            {{ $slot }}
        </select>

    @else
        <input
            type="{{ $type }}"
            id="{{ $id }}"
            name="{{ $name }}"
            value="{{ $oldValue }}"
            placeholder="{{ $placeholder }}"
            class="{{ $inputClasses }}"
            @if($required) required @endif
            {{ $attributes }}
        />
    @endif

    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
