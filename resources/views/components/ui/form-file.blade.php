{{-- resources/views/components/ui/form-file.blade.php --}}
@props(['name', 'label', 'required' => false, 'accept' => '', 'help' => ''])

<div>
    <label for="{{ $name }}" class="block text-sm font-semibold leading-6 text-gray-900 mb-2">
        {{ $label }}
        @if($required)
            <span class="text-red-500 ml-1">*</span>
        @endif
    </label>
    <div class="relative">
        <div class="flex items-center justify-center w-full">
            <label for="{{ $name }}" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 hover:border-indigo-300 transition-colors duration-200 group">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-3 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 group-hover:text-indigo-600">
                        <span class="font-semibold">Klik untuk upload</span> atau drag and drop
                    </p>
                    @if($help)
                        <p class="text-xs text-gray-500">{{ $help }}</p>
                    @endif
                </div>
                <input id="{{ $name }}"
                       name="{{ $name }}"
                       type="file"
                       accept="{{ $accept }}"
                       {{ $required ? 'required' : '' }}
                       class="hidden"
                       {{ $attributes }}>
            </label>
        </div>
        @error($name)
            <div class="absolute top-2 right-2">
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
