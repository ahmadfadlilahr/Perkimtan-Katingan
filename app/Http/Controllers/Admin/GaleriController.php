<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri; // Tambahkan ini
use App\Services\GaleriService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class GaleriController extends Controller
{
    protected $galeriService;

    public function __construct(GaleriService $galeriService)
    {
        $this->galeriService = $galeriService;
        $this->middleware('can:kelola galeri');
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');

        $semua_galeri = $this->galeriService->getAllGaleri($search, 12, $sort, $order);

        return view('admin.galeri.index', [
            'semua_galeri' => $semua_galeri,
            'search' => $search,
            'sort' => $sort,
            'order' => $order
        ]);
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Gambar wajib, maks 2MB
            'keterangan' => 'nullable|string|max:255',
        ]);

        // 2. Simpan menggunakan service
        $this->galeriService->createGaleri($request->all());

        // 3. Redirect dengan pesan sukses
        return redirect()->route('dashboard.galeri.index')->with('success', 'Foto baru berhasil ditambahkan ke galeri!');
    }

    public function edit(Galeri $galeri)
{
    return view('admin.galeri.edit', [
        'galeri' => $galeri
    ]);
}

public function update(Request $request, Galeri $galeri)
{
    $request->validate([
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Gambar opsional saat update
        'keterangan' => 'nullable|string|max:255',
    ]);

    $this->galeriService->updateGaleri($galeri, $request->all());

    return redirect()->route('dashboard.galeri.index')->with('success', 'Foto galeri berhasil diperbarui!');
}

public function destroy(Galeri $galeri)
{
    $this->galeriService->deleteGaleri($galeri);
    return redirect()->route('dashboard.galeri.index')->with('success', 'Foto galeri berhasil dihapus!');
}
}
