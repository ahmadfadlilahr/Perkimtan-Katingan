<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan ini
use Illuminate\Support\Facades\Log;

class SlideController extends Controller
{
    // ... (method index dan create) ...
    public function index()
    {
        $semua_slide = Slide::orderBy('urutan', 'asc')->paginate(10);
        return view('admin.slide.index', [
            'semua_slide' => $semua_slide
        ]);
    }

    public function create()
    {
        return view('admin.slide.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Slide Store - Method dipanggil!');
        Log::info('Slide Store - Data request: ', $request->all());
        Log::info('Slide Store - Files: ', $request->allFiles());
        Log::info('Slide Store - Content Type: ' . $request->header('Content-Type'));

        // 1. Validasi
        try {
            $request->validate([
                'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
                'judul' => 'nullable|string|max:255',
                'subjudul' => 'nullable|string',
                'tombol_teks' => 'nullable|string|max:50',
                'tombol_url' => 'nullable|string|max:255',
                'urutan' => 'required|integer',
                'status' => 'required|in:published,draft',
            ]);
            Log::info('Slide Store - Validasi berhasil');
        } catch (\Exception $e) {
            Log::error('Slide Store - Validasi gagal: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }

        // 2. Proses upload gambar
        if ($request->hasFile('gambar')) {
            Log::info('Slide - File gambar ditemukan: ' . $request->file('gambar')->getClientOriginalName());
            $path = $request->file('gambar')->store('slide', 'public');
            $namaGambar = basename($path);
            Log::info('Slide - Gambar disimpan sebagai: ' . $namaGambar);
        } else {
            Log::error('Slide - Tidak ada file gambar yang diupload!');
            return redirect()->back()->withInput()->with('error', 'File gambar wajib diupload!');
        }

        // 3. Simpan data ke database
        Slide::create([
            'gambar' => $namaGambar,
            'judul' => $request->judul,
            'subjudul' => $request->subjudul,
            'tombol_teks' => $request->tombol_teks,
            'tombol_url' => $request->tombol_url,
            'urutan' => $request->urutan,
            'status' => $request->status,
        ]);

        // 4. Redirect dengan pesan sukses
        return redirect()->route('dashboard.slide.index')->with('success', 'Slide baru berhasil ditambahkan!');
    }

    // ... (method index, create, store yang sudah ada) ...

public function edit(Slide $slide)
{
    return view('admin.slide.edit', [
        'slide' => $slide
    ]);
}

public function update(Request $request, Slide $slide)
{
    $request->validate([
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'judul' => 'nullable|string|max:255',
        'subjudul' => 'nullable|string',
        'tombol_teks' => 'nullable|string|max:50',
        'tombol_url' => 'nullable|string|max:255',
        'urutan' => 'required|integer',
        'status' => 'required|in:published,draft',
    ]);

    // Prepare data untuk update
    $data = [
        'judul' => $request->judul,
        'subjudul' => $request->subjudul,
        'tombol_teks' => $request->tombol_teks,
        'tombol_url' => $request->tombol_url,
        'urutan' => $request->urutan,
        'status' => $request->status,
    ];

    if ($request->hasFile('gambar')) {
        Log::info('Slide Update - File gambar ditemukan: ' . $request->file('gambar')->getClientOriginalName());
        if ($slide->gambar) {
            Storage::disk('public')->delete('slide/' . $slide->gambar);
            Log::info('Slide Update - Gambar lama dihapus: ' . $slide->gambar);
        }
        $path = $request->file('gambar')->store('slide', 'public');
        $data['gambar'] = basename($path);
        Log::info('Slide Update - Gambar baru disimpan sebagai: ' . basename($path));
    } else {
        Log::info('Slide Update - Tidak ada file gambar yang diupload untuk update');
    }

    $slide->update($data);

    return redirect()->route('dashboard.slide.index')->with('success', 'Slide berhasil diperbarui!');
}

public function destroy(Slide $slide)
{
    if ($slide->gambar) {
        Storage::disk('public')->delete('slide/' . $slide->gambar);
    }
    $slide->delete();
    return redirect()->route('dashboard.slide.index')->with('success', 'Slide berhasil dihapus!');
}

public function __construct()
{
    $this->middleware('can:kelola slider');
}
}
