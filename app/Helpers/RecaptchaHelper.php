<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecaptchaHelper
{
    /**
     * Verify reCAPTCHA response
     *
     * @param string $response
     * @param string $remoteip
     * @return bool
     */
    public static function verify($response, $remoteip = null)
    {
        $secretKey = config('services.recaptcha.secret_key');

        if (empty($secretKey)) {
            return false;
        }

        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $secretKey,
                'response' => $response,
                'remoteip' => $remoteip
            ]);

            $result = $response->json();

            return isset($result['success']) && $result['success'] === true;
        } catch (\Exception $e) {
            Log::error('reCAPTCHA verification failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get reCAPTCHA site key
     *
     * @return string
     */
    public static function getSiteKey()
    {
        return config('services.recaptcha.site_key');
    }

    /**
     * Check if reCAPTCHA is enabled
     *
     * @return bool
     */
    public static function isEnabled()
    {
        return !empty(config('services.recaptcha.site_key')) &&
               !empty(config('services.recaptcha.secret_key'));
    }
}
