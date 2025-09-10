<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Services\BeritaService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $beritaService;

    public function __construct(BeritaService $beritaService)
    {
        $this->beritaService = $beritaService;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');

        // Menggunakan service untuk mendapatkan berita published dengan pencarian dan pagination
        if ($search) {
            $beritas = $this->beritaService->searchPublishedBerita($search, 6);
        } else {
            $beritas = $this->beritaService->getPublishedBerita(6);
        }

        return view('berita.index', [
            'beritas' => $beritas,
            'search' => $search
        ]);
    }

    /**
     * Menampilkan halaman detail satu berita.
     */
    public function show($slug)
    {
        try {
            // Menggunakan service untuk mendapatkan berita by slug
            $berita = $this->beritaService->getBeritaBySlug($slug, true);

            return view('berita.show', [
                'berita' => $berita
            ]);
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
