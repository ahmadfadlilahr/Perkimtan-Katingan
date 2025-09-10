<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MathCaptchaRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $expectedAnswer = request()->input('captcha_expected');

        if (empty($expectedAnswer)) {
            $fail('CAPTCHA verification is required.');
            return;
        }

        if (empty($value)) {
            $fail('Mohon selesaikan perhitungan CAPTCHA.');
            return;
        }

        if ((int) $value !== (int) $expectedAnswer) {
            $fail('Jawaban CAPTCHA tidak benar. Silakan coba lagi.');
        }
    }
}
