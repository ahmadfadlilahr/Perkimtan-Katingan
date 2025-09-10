<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BeritaPageController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\PejabatController;
// use App\Http\Controllers\Admin\UnduhanController; // Kita ganti ini
use App\Http\Controllers\Admin\PesanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\VisiMisiController as AdminVisiMisiController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AgendaController as PublicAgendaController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\GaleriController as PublicGaleriController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProfilController;

// 👇👇 1. TAMBAHKAN DUA 'use' STATEMENT INI UNTUK UNDUHAN 👇👇
use App\Http\Controllers\UnduhanController as PublicUnduhanController;
use App\Http\Controllers\Admin\UnduhanController as AdminUnduhanController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ======================================================
// RUTE UNTUK WEBSITE PUBLIK
// ======================================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [PostController::class, 'index'])->name('berita.index.public');
Route::get('/berita/{slug}', [PostController::class, 'show'])->name('berita.show.public');

// 👇👇 RUTE PROFIL BARU (HARD CODED) 👇👇
Route::get('/visi-dan-misi', [ProfilController::class, 'visiMisi'])->name('profil.visi-misi');

// 👇👇 RUTE AGENDA DINAMIS (MENGGANTIKAN HALAMAN) 👇👇
Route::get('/agenda', [PublicAgendaController::class, 'index'])->name('agenda.index.public');
Route::get('/agenda/{slug}', [PublicAgendaController::class, 'show'])->name('agenda.show.public');

Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('struktur-organisasi.public');
Route::get('/galeri', [PublicGaleriController::class, 'index'])->name('galeri.public');

// 👇👇 2. TAMBAHKAN RUTE PUBLIK UNTUK UNDUHAN DI SINI 👇👇
Route::get('/unduhan', [PublicUnduhanController::class, 'index'])->name('unduhan.public');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.public');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store.public');


// ======================================================
// RUTE UNTUK AREA AUTHENTIKASI & ADMIN
// ======================================================
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Grup Rute untuk Admin Panel
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // Activity logs management
    Route::post('/activity/cleanup', [DashboardController::class, 'cleanupActivityLogs'])->name('activity.cleanup');

    // ... (rute-rute admin lainnya)
    Route::get('/berita', [BeritaPageController::class, 'index'])->name('berita.index');
    Route::get('/berita/create', [BeritaPageController::class, 'create'])->name('berita.create');
    Route::post('/berita', [BeritaPageController::class, 'store'])->name('berita.store');
    Route::get('/berita/{berita}/edit', [BeritaPageController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{berita}', [BeritaPageController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{berita}', [BeritaPageController::class, 'destroy'])->name('berita.destroy');
    Route::resource('agenda', AgendaController::class);
    Route::resource('pejabat', PejabatController::class);

    // 👇👇 3. GUNAKAN ALIAS UNTUK RUTE ADMIN UNDUHAN 👇👇
    Route::resource('unduhan', AdminUnduhanController::class);

    Route::resource('galeri', AdminGaleriController::class);
    Route::resource('pesan', PesanController::class)->except(['create', 'store']);
    Route::resource('pengguna', UserController::class);
    Route::resource('slide', SlideController::class);

    // Visi Misi Management
    Route::resource('visi-misi', AdminVisiMisiController::class);
    Route::post('visi-misi/{visiMisi}/toggle-active', [AdminVisiMisiController::class, 'toggleActive'])->name('visi-misi.toggle-active');
    Route::post('visi-misi/reorder', [AdminVisiMisiController::class, 'reorder'])->name('visi-misi.reorder');
});

// Rute untuk upload TinyMCE
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/upload/image', [UploadController::class, 'uploadImage'])->name('upload.image');
    Route::delete('/upload/image', [UploadController::class, 'deleteImage'])->name('upload.delete');
});

// Test route untuk debug upload
Route::get('/test-upload', function () {
    return view('test-upload');
})->middleware('auth');

require __DIR__.'/auth.php';

// Emergency logout route for CSRF issues
Route::post('/emergency-logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    session()->flush();

    // Force new session
    session()->migrate(true);

    return redirect('/login')->with('status', 'Emergency logout completed - you can now login again');
});
