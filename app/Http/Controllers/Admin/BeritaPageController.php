<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\ActivityLog;
use App\Services\BeritaService;
use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class BeritaPageController extends Controller
{
    protected $beritaService;

    public function __construct(BeritaService $beritaService)
    {
        $this->beritaService = $beritaService;
        // Lindungi semua method di controller ini dengan izin 'kelola berita'
        $this->middleware('can:kelola berita');
    }

    public function index(Request $request)
    {
        // Prepare filters array from request
        $filters = [];

        // Add search filter if exists
        if ($request->filled('search')) {
            $filters['search'] = $request->input('search');
        }

        // Add status filter if exists
        if ($request->filled('status')) {
            $filters['status'] = $request->input('status');
        }

        // Menggunakan service dengan filter untuk admin (semua status)
        $beritas = $this->beritaService->getAllBerita($filters, 10);

        // Append query parameters to pagination links
        $beritas->appends($request->query());

        return view('admin.berita.index', [
            'semua_berita' => $beritas
        ]);
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Method untuk menyimpan berita baru ke database.
     */
    public function store(StoreBeritaRequest $request)
    {
        Log::info('Berita Store - Method dipanggil!');
        Log::info('Berita Store - Data request: ', $request->all());
        Log::info('Berita Store - Files: ', $request->allFiles());
        Log::info('Berita Store - Content Type: ' . $request->header('Content-Type'));

        try {
            $berita = $this->beritaService->createBerita(
                $request->validated(),
                $request->file('gambar')
            );

            // Log activity
            ActivityLog::createLog(
                'create',
                'Berita',
                $berita->id,
                $berita->judul
            );

            return redirect()->route('dashboard.berita.index')
                ->with('success', 'Berita baru berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan form untuk mengedit berita.
     */
    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', [
            'berita' => $berita
        ]);
    }

    /**
     * Method untuk memproses update data berita.
     */
    public function update(UpdateBeritaRequest $request, Berita $berita)
    {
        try {
            // Simpan data lama untuk logging
            $oldTitle = $berita->judul;

            $updatedBerita = $this->beritaService->updateBerita(
                $berita,
                $request->validated(),
                $request->file('gambar')
            );

            // Log activity
            ActivityLog::createLog(
                'update',
                'Berita',
                $berita->id,
                $oldTitle
            );

            return redirect()->route('dashboard.berita.index')
                ->with('success', 'Berita berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Berita $berita)
    {
        try {
            // Simpan data untuk logging sebelum dihapus
            $beritaTitle = $berita->judul;
            $beritaId = $berita->id;

            $this->beritaService->deleteBerita($berita);

            // Log activity
            ActivityLog::createLog(
                'delete',
                'Berita',
                $beritaId,
                $beritaTitle
            );

            return redirect()->route('dashboard.berita.index')
                ->with('success', 'Berita berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
