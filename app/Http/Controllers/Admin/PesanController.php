<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesan; // 1. Impor Model Pesan
use App\Services\PesanService;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    protected $pesanService;

    public function __construct(PesanService $pesanService)
    {
        $this->pesanService = $pesanService;
        $this->middleware('can:kelola pesan');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data pesan menggunakan service
        $semua_pesan = $this->pesanService->getAllPesan(null, 15);

        // Kembalikan view dan kirim datanya
        return view('admin.pesan.index', [
            'semua_pesan' => $semua_pesan
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesan $pesan)
    {
        // Secara otomatis update status menjadi 'Sudah Dibaca' jika dibuka
        if ($pesan->status == 'Belum Dibaca') {
            $this->pesanService->markAsRead($pesan);
        }

        // Tampilkan view detail pesan dan kirim data pesan tersebut
        return view('admin.pesan.show', [
            'pesan' => $pesan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Pesan $pesan)
    {
        // Hapus pesan menggunakan service
        $this->pesanService->deletePesan($pesan);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('dashboard.pesan.index')->with('success', 'Pesan berhasil dihapus!');
    }
}
