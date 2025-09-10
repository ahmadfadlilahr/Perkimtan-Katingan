<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Dinas Perkim API Documentation",
 *     description="RESTful API untuk sistem manajemen berita Dinas Perkim dengan Laravel Sanctum authentication. API ini dapat diakses dari berbagai domain dan environment."
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Development Server (Laravel Artisan Serve)"
 * )
 *
 * @OA\Server(
 *     url="http://dinas-perkim.test",
 *     description="Local Development Server (Laragon Virtual Host)"
 * )
 *
 * @OA\Server(
 *     url="https://api.dinasperkim.go.id",
 *     description="Production Server (Example)"
 * )
 *
 * @OA\Server(
 *     url="https://staging.dinasperkim.go.id",
 *     description="Staging Server (Example)"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Enter token in format: Bearer {token}"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
