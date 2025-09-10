@props(['name', 'placeholder' => '', 'required' => false, 'rows' => 4, 'value' => ''])

@php
$hasError = $errors->has($name);
$baseClasses = 'w-full rounded-lg shadow-sm';
$normalClasses = 'border-gray-300 focus:border-emerald-500 focus:ring-emerald-500';
$errorClasses = 'border-red-300 focus:border-red-500 focus:ring-red-500';
$textareaClasses = $hasError ? "{$baseClasses} {$errorClasses}" : "{$baseClasses} {$normalClasses}";
@endphp

<textarea
    id="{{ $name }}"
    name="{{ $name }}"
    rows="{{ $rows }}"
    placeholder="{{ $placeholder }}"
    class="{{ $textareaClasses }}"
    @if($required) required @endif
    {{ $attributes }}
>{{ old($name, $value) }}</textarea>

@error($name)
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
@enderror
