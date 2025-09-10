<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\GaleriController;
use App\Http\Controllers\Api\AgendaController;
use App\Http\Controllers\Api\PejabatController;
use App\Http\Controllers\Api\PesanController;
use App\Http\Controllers\Api\SlideController;
use App\Http\Controllers\Api\UnduhanController;
use App\Http\Controllers\Api\VisiMisiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Authentication Routes - Public (no middleware)
Route::post('login', [AuthController::class, 'login']);

// Public Endpoints - No authentication required
Route::prefix('public')->group(function () {
    // Berita Public Routes
    Route::get('berita', [BeritaController::class, 'publicIndex'])->name('berita.public.index');
    Route::get('berita/{slug}', [BeritaController::class, 'publicShow'])->name('berita.public.show');

    // Galeri Public Routes
    Route::get('galeri', [GaleriController::class, 'publicIndex'])->name('galeri.public.index');
    Route::get('galeri/{id}', [GaleriController::class, 'publicShow'])->name('galeri.public.show');

    // Agenda Public Routes
    Route::get('agenda', [AgendaController::class, 'publicIndex'])->name('agenda.public.index');
    Route::get('agenda/{slug}', [AgendaController::class, 'publicShow'])->name('agenda.public.show');

    // Pejabat Public Routes
    Route::get('pejabat', [PejabatController::class, 'publicIndex'])->name('pejabat.public.index');
    Route::get('pejabat/{id}', [PejabatController::class, 'publicShow'])->name('pejabat.public.show');

    // Pesan Public Routes (Contact Form) - With Rate Limiting
    Route::middleware(['throttle:5,1'])->group(function () {
        Route::post('pesan', [PesanController::class, 'publicStore'])->name('pesan.public.store');
    });

    // Slide Public Routes (for carousel)
    Route::get('slide', [SlideController::class, 'publicIndex'])->name('slide.public.index');
    Route::get('slide/{id}', [SlideController::class, 'publicShow'])->name('slide.public.show');

    // Unduhan Public Routes (for downloads)
    Route::get('unduhan', [UnduhanController::class, 'publicIndex'])->name('unduhan.public.index');
    Route::get('unduhan/{id}', [UnduhanController::class, 'publicShow'])->name('unduhan.public.show');
    Route::get('unduhan/{id}/download', [UnduhanController::class, 'download'])->name('unduhan.public.download');

    // Visi Misi Public Routes
    Route::get('visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi.public.index');
});

// Legacy public routes (for backward compatibility)
Route::get('berita-public', [BeritaController::class, 'publicIndex'])->name('berita.public.legacy');
Route::get('berita-public/{slug}', [BeritaController::class, 'publicShow'])->name('berita.show.public.legacy');

// Protected Routes - Require authentication (API only with Sanctum)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);

    // Berita CRUD - Protected endpoints
    Route::apiResource('berita', BeritaController::class)->parameters(['berita' => 'berita']);

    // Galeri CRUD - Protected endpoints
    Route::apiResource('galeri', GaleriController::class)->parameters(['galeri' => 'galeri']);

    // Agenda CRUD - Protected endpoints
    Route::apiResource('agenda', AgendaController::class)->parameters(['agenda' => 'agenda']);

    // Pejabat CRUD - Protected endpoints
    Route::apiResource('pejabat', PejabatController::class)->parameters(['pejabat' => 'pejabat']);

    // Pesan Management - Protected endpoints
    Route::apiResource('pesan', PesanController::class)->except(['store'])->parameters(['pesan' => 'pesan']);
    Route::get('pesan/stats', [PesanController::class, 'stats'])->name('pesan.stats');

    // Slide Management - Protected endpoints (Fixed naming consistency)
    Route::apiResource('slide', SlideController::class)->parameters(['slide' => 'slide']);
    Route::post('slide/reorder', [SlideController::class, 'reorder'])->name('slide.reorder');
    Route::put('slide/{slide}/toggle-status', [SlideController::class, 'toggleStatus'])->name('slide.toggle-status');
    Route::get('slide/stats', [SlideController::class, 'stats'])->name('slide.stats');

    // Unduhan Management - Protected endpoints
    Route::apiResource('unduhan', UnduhanController::class)->parameters(['unduhan' => 'unduhan']);
    Route::get('unduhan/stats', [UnduhanController::class, 'stats'])->name('unduhan.stats');

    // Dashboard - Protected endpoints
    Route::prefix('dashboard')->group(function () {
        Route::get('stats', [DashboardController::class, 'stats'])->name('dashboard.stats');
        Route::get('recent-activities', [DashboardController::class, 'recentActivities'])->name('dashboard.recent-activities');
        Route::get('summary', [DashboardController::class, 'summary'])->name('dashboard.summary');
    });

    // User Management - Protected endpoints
    Route::apiResource('users', UserController::class)->parameters(['users' => 'user']);
    Route::put('users/{user}/change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::put('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

    // Visi Misi Management - Protected endpoints
    Route::apiResource('visi-misi', VisiMisiController::class)->parameters(['visi-misi' => 'visiMisi']);
    Route::post('visi-misi/{visiMisi}/toggle-active', [VisiMisiController::class, 'toggleActive'])->name('visi-misi.toggle-active');
    Route::post('visi-misi/reorder', [VisiMisiController::class, 'reorder'])->name('visi-misi.reorder');
});
