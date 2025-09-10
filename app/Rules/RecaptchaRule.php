<?php

namespace App\Rules;

use App\Helpers\RecaptchaHelper;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RecaptchaRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Skip validation if reCAPTCHA is not enabled
        if (!RecaptchaHelper::isEnabled()) {
            return;
        }

        // Check if value is provided
        if (empty($value)) {
            $fail('reCAPTCHA verification is required.');
            return;
        }

        // Verify reCAPTCHA
        $remoteIp = request()->ip();

        if (!RecaptchaHelper::verify($value, $remoteIp)) {
            $fail('reCAPTCHA verification failed. Please try again.');
        }
    }
}
