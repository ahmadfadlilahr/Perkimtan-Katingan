@props([
    'label' => 'Verifikasi CAPTCHA',
    'required' => true,
    'class' => ''
])

@php
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
    $operation = rand(0, 1) ? '+' : '-';
    $answer = $operation === '+' ? $num1 + $num2 : $num1 - $num2;

    // For subtraction, ensure positive result
    if ($operation === '-' && $num2 > $num1) {
        $temp = $num1;
        $num1 = $num2;
        $num2 = $temp;
        $answer = $num1 - $num2;
    }
@endphp

<div class="mb-6 {{ $class }}">
    @if($label)
    <label class="block text-sm font-medium text-gray-700 mb-3">
        {{ $label }}
        @if($required)
            <span class="text-red-500 ml-1">*</span>
        @endif
    </label>
    @endif

    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-center justify-center space-x-4">
            <div class="text-2xl font-bold text-gray-800 bg-white px-3 py-2 rounded shadow">
                {{ $num1 }}
            </div>
            <div class="text-2xl font-bold text-blue-600">
                {{ $operation }}
            </div>
            <div class="text-2xl font-bold text-gray-800 bg-white px-3 py-2 rounded shadow">
                {{ $num2 }}
            </div>
            <div class="text-2xl font-bold text-blue-600">
                =
            </div>
            <div class="flex-1">
                @php
                    $captchaInputClass = 'w-full px-3 py-2 text-lg font-bold text-center border rounded-lg focus:ring-2 ';
                    $captchaInputClass .= $errors->has('captcha_answer')
                        ? 'border-red-500 focus:ring-red-500 focus:border-red-500'
                        : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500';
                @endphp
                <input type="number"
                       name="captcha_answer"
                       id="captcha_answer"
                       class="{{ $captchaInputClass }}"
                       placeholder="?"
                       autocomplete="off"
                       required="{{ $required ? 'true' : 'false' }}">
            </div>
        </div>

        <input type="hidden" name="captcha_expected" value="{{ $answer }}">

        <p class="text-xs text-gray-600 mt-2 text-center">
            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9a12.02 12.02 0 00-.382-3.016z"/>
            </svg>
            Selesaikan perhitungan sederhana di atas untuk melanjutkan
        </p>
    </div>

    @error('captcha_answer')
        <div class="mt-2 text-sm text-red-600 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            {{ $message }}
        </div>
    @enderror
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const captchaInput = document.getElementById('captcha_answer');

    if (captchaInput) {
        // Add real-time validation feedback
        captchaInput.addEventListener('input', function() {
            const expected = document.querySelector('[name="captcha_expected"]').value;
            const userAnswer = this.value;

            if (userAnswer && parseInt(userAnswer) === parseInt(expected)) {
                this.classList.remove('border-red-500');
                this.classList.add('border-green-500');
            } else if (userAnswer) {
                this.classList.remove('border-green-500');
                this.classList.add('border-red-500');
            } else {
                this.classList.remove('border-green-500', 'border-red-500');
            }
        });

        // Prevent copy/paste for security
        captchaInput.addEventListener('paste', function(e) {
            e.preventDefault();
            return false;
        });

        // Auto focus disabled to prevent auto scrolling
        // setTimeout(() => {
        //     captchaInput.focus();
        // }, 500);
    }
});
</script>
@endpush
