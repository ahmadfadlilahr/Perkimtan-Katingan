<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => array_filter([
        // Development domains
        'http://localhost:8000',
        'http://dinas-perkim.test',
        'http://127.0.0.1:8000',
        'http://localhost',
        'http://localhost:3000', // React/Vue development

        // Production domains
        env('CORS_ALLOWED_ORIGIN_1'), // Set in production .env
        env('CORS_ALLOWED_ORIGIN_2'), // Set in production .env

        // Correct production domains
        'https://perkimtan.katingankab.go.id',
        'https://www.perkimtan.katingankab.go.id',
        'http://perkimtan.katingankab.go.id',
        'http://www.perkimtan.katingankab.go.id',

        // Additional domains
        'https://dinasperkim.katingankab.go.id',
        'https://www.dinasperkim.katingankab.go.id',
        'https://api.dinasperkim.katingankab.go.id',
    ]),

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
