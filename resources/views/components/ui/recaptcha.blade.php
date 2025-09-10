@props([
    'siteKey' => config('services.recaptcha.site_key'),
    'theme' => 'light',
    'size' => 'normal',
    'label' => 'Verifikasi reCAPTCHA',
    'required' => true,
    'class' => ''
])

@if($siteKey)
<div class="mb-6 {{ $class }}">
    @if($label)
    <label class="block text-sm font-medium text-gray-700 mb-3">
        {{ $label }}
        @if($required)
            <span class="text-red-500 ml-1">*</span>
        @endif
    </label>
    @endif

    <div class="flex justify-center">
        <div class="g-recaptcha"
             data-sitekey="{{ $siteKey }}"
             data-theme="{{ $theme }}"
             data-size="{{ $size }}"
             data-callback="onRecaptchaSuccess"
             data-expired-callback="onRecaptchaExpired"
             data-error-callback="onRecaptchaError">
        </div>
    </div>

    @error('g-recaptcha-response')
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
// reCAPTCHA callback functions
function onRecaptchaSuccess(token) {
    console.log('reCAPTCHA verified successfully');

    // Remove any existing error styling
    const recaptchaContainer = document.querySelector('.g-recaptcha');
    if (recaptchaContainer) {
        recaptchaContainer.classList.remove('border-red-500');
        const errorMessage = recaptchaContainer.parentNode.querySelector('.text-red-600');
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }
}

function onRecaptchaExpired() {
    console.log('reCAPTCHA expired');

    // Show visual feedback
    const recaptchaContainer = document.querySelector('.g-recaptcha');
    if (recaptchaContainer) {
        recaptchaContainer.classList.add('border-red-500');
    }
}

function onRecaptchaError() {
    console.log('reCAPTCHA error');

    // Show visual feedback
    const recaptchaContainer = document.querySelector('.g-recaptcha');
    if (recaptchaContainer) {
        recaptchaContainer.classList.add('border-red-500');
    }
}

// Form submission validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const recaptchaResponse = document.querySelector('[name="g-recaptcha-response"]');
            if (recaptchaResponse && !recaptchaResponse.value) {
                e.preventDefault();

                // Show error styling without scrolling
                const recaptchaContainer = document.querySelector('.g-recaptcha');
                if (recaptchaContainer) {
                    // Removed scrollIntoView to prevent auto scroll
                    recaptchaContainer.classList.add('border-red-500');

                    // Show error message
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'mt-2 text-sm text-red-600 flex items-center';
                    errorDiv.innerHTML = `
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        Mohon selesaikan verifikasi reCAPTCHA terlebih dahulu.
                    `;

                    // Remove existing error message
                    const existingError = recaptchaContainer.parentNode.querySelector('.text-red-600');
                    if (existingError) {
                        existingError.remove();
                    }

                    recaptchaContainer.parentNode.appendChild(errorDiv);
                }
            }
        });
    }
});
</script>
@endpush
@endif
