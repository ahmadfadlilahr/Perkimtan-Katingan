<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unduhan;
use App\Services\UnduhanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UnduhanController extends Controller
{
    protected $unduhanService;

    public function __construct(UnduhanService $unduhanService)
    {
        $this->unduhanService = $unduhanService;
        $this->middleware('can:kelola unduhan');
    }

    /**
     * Display a listing of the resource with search functionality.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);

        $semua_unduhan = $this->unduhanService->getAllUnduhan(
            search: $search,
            perPage: $perPage,
            sort: 'created_at',
            order: 'desc'
        );

        // Preserve query parameters in pagination
        $semua_unduhan->appends($request->query());

        return view('admin.unduhan.index', compact('semua_unduhan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.unduhan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,zip,rar|max:10240', // File wajib, maks 10MB
        ]);

        $data = $request->only(['judul', 'deskripsi']);
        $data['file'] = $request->file('file');

        $this->unduhanService->createUnduhan($data);

        return redirect()->route('dashboard.unduhan.index')
                        ->with('success', 'File unduhan baru berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unduhan $unduhan)
    {
        return view('admin.unduhan.edit', compact('unduhan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unduhan $unduhan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip,rar|max:10240', // File opsional saat update
        ]);

        $data = $request->only(['judul', 'deskripsi']);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file');
        }

        $this->unduhanService->updateUnduhan($unduhan, $data);

        return redirect()->route('dashboard.unduhan.index')
                        ->with('success', 'File unduhan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unduhan $unduhan)
    {
        $this->unduhanService->deleteUnduhan($unduhan);

        return redirect()->route('dashboard.unduhan.index')
                        ->with('success', 'File unduhan berhasil dihapus!');
    }
}
