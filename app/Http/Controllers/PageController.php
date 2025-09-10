<?php

namespace App\Http\Controllers;

use App\Models\Halaman; // 1. Impor Model Halaman
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Menampilkan satu halaman statis berdasarkan slug.
     */
    public function show($slug)
    {
        // 2. Cari halaman di database berdasarkan slug-nya.
        // Kita juga hanya akan menampilkan halaman yang statusnya 'published'.
        // firstOrFail() akan otomatis menampilkan halaman 404 Not Found jika tidak ada.
        $halaman = Halaman::where('slug', $slug)->where('status', 'published')->firstOrFail();

        // 3. Tampilkan view detail dan kirim data halaman yang ditemukan
        return view('page.show', [
            'halaman' => $halaman
        ]);
    }
}
