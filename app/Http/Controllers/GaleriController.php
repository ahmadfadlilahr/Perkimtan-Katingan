<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        // Ambil semua data galeri, urutkan dari yang terbaru, dan gunakan paginasi
        // Angka 12 adalah angka yang bagus untuk layout grid (bisa dibagi 2, 3, dan 4)
        $fotos = Galeri::latest()->paginate(12);

        return view('galeri.index', [
            'fotos' => $fotos
        ]);
    }
}
