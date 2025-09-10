@props(['name', 'required' => false, 'options' => [], 'value' => '', 'placeholder' => 'Pilih...'])

@php
$hasError = $errors->has($name);
$baseClasses = 'w-full rounded-lg shadow-sm';
$normalClasses = 'border-gray-300 focus:border-emerald-500 focus:ring-emerald-500';
$errorClasses = 'border-red-300 focus:border-red-500 focus:ring-red-500';
$selectClasses = $hasError ? "{$baseClasses} {$errorClasses}" : "{$baseClasses} {$normalClasses}";
@endphp

<select
    id="{{ $name }}"
    name="{{ $name }}"
    class="{{ $selectClasses }}"
    @if($required) required @endif
    {{ $attributes }}
>
    @if($placeholder)
        <option value="">{{ $placeholder }}</option>
    @endif
    @foreach($options as $optionValue => $optionLabel)
        <option value="{{ $optionValue }}" @if(old($name, $value) == $optionValue) selected @endif>
            {{ $optionLabel }}
        </option>
    @endforeach
</select>

@error($name)
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
@enderror
