<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Unduhan;
use App\Models\Pejabat;
use App\Models\Agenda;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data slide yang statusnya 'published', urutkan berdasarkan kolom 'urutan'
        $slides = Slide::where('status', 'published')->orderBy('urutan', 'asc')->get();

        // Ambil berita terbaru langsung dari model (tanpa HTTP request)
        $beritaTerbaru = Berita::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Ambil galeri preview (8 foto terbaru)
        $galeriPreview = Galeri::latest()->limit(8)->get();

        // Ambil unduhan populer (6 file terbaru)
        $unduhanPreview = Unduhan::latest()->limit(6)->get();

        // Ambil pejabat utama (Kepala Dinas, Sekretaris, dan 1 Kepala Bidang)
        $pejabatUtama = collect();

        // Kepala Dinas
        $kepalaDinas = Pejabat::where('jabatan', 'Kepala Dinas')->orderBy('urutan', 'asc')->first();
        if ($kepalaDinas) {
            $pejabatUtama->push($kepalaDinas);
        }

        // Sekretaris
        $sekretaris = Pejabat::where('jabatan', 'Sekretaris')->orderBy('urutan', 'asc')->first();
        if ($sekretaris) {
            $pejabatUtama->push($sekretaris);
        }

        // Satu Kepala Bidang
        $kepalaBidang = Pejabat::where('jabatan', 'LIKE', 'Kepala Bidang%')->orderBy('urutan', 'asc')->first();
        if ($kepalaBidang) {
            $pejabatUtama->push($kepalaBidang);
        }

        // Hitung statistik
        $statistik = [
            'berita' => Berita::where('status', 'published')->count(),
            'galeri' => Galeri::count(),
            'unduhan' => Unduhan::count(),
            'pejabat' => Pejabat::count(),
            'agenda' => Agenda::where('status', 'published')->count(),
            'tahun_pelayanan' => date('Y') - 2020, // Anggap mulai tahun 2020
        ];

        // Kirim semua data ke view
        return view('home', [
            'slides' => $slides,
            'beritaTerbaru' => $beritaTerbaru,
            'galeriPreview' => $galeriPreview,
            'unduhanPreview' => $unduhanPreview,
            'pejabatUtama' => $pejabatUtama,
            'statistik' => $statistik
        ]);
    }
}
