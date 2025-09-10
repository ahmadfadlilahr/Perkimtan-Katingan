<?php

namespace App\Http\Controllers;

use App\Models\Pejabat;
use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller
{
    /**
     * Menampilkan halaman publik untuk struktur organisasi.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // PENTING: Logika ini bergantung pada data 'jabatan' yang konsisten di database Anda.
        // Struktur: Kepala Dinas > Sekretaris > Kepala Bidang > Kasubag > Kepala Seksi

        // Level 1: Kepala Dinas (asumsi jabatannya persis 'Kepala Dinas')
        $kepalaDinas = Pejabat::where('jabatan', 'Kepala Dinas')->orderBy('urutan', 'asc')->first();

        // Level 2: Sekretaris (asumsi jabatannya persis 'Sekretaris')
        $sekretaris = Pejabat::where('jabatan', 'Sekretaris')->orderBy('urutan', 'asc')->first();

        // Level 3: Kepala Bidang (asumsi jabatannya diawali dengan 'Kepala Bidang')
        $kepalaBidang = Pejabat::where('jabatan', 'LIKE', 'Kepala Bidang%')->orderBy('urutan', 'asc')->get();

        // Level 4: Kasubag (Kepala Sub Bagian)
        $kasubag = Pejabat::where('jabatan', 'LIKE', 'Kasubag%')->orderBy('urutan', 'asc')->get();

        // Level 5: Kepala Seksi
        $kepalaSeksi = Pejabat::where('jabatan', 'LIKE', 'Kepala Seksi%')->orderBy('urutan', 'asc')->get();

        return view('struktur-organisasi.index', compact('kepalaDinas', 'sekretaris', 'kepalaBidang', 'kasubag', 'kepalaSeksi'));
    }
}
