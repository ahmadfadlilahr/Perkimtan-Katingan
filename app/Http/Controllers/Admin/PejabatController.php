<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pejabat; // Tambahkan ini
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan ini
use Illuminate\Support\Facades\Log;

class PejabatController extends Controller
{
    public function index()
    {
        $semua_pejabat = Pejabat::orderBy('urutan', 'asc')->paginate(10);
        return view('admin.pejabat.index', [
            'semua_pejabat' => $semua_pejabat
        ]);
    }

    public function create()
    {
        return view('admin.pejabat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan_dasar' => 'required|string',
            'nama_bidang' => 'nullable|string|max:255', // Nama bidang opsional
            'nama_subbag' => 'nullable|string|max:255', // Nama sub bagian opsional
            'nama_seksi' => 'nullable|string|max:255', // Nama seksi opsional
            'nip' => 'nullable|string|max:255|unique:pejabats,nip',
            'urutan' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Gabungkan jabatan berdasarkan jenis jabatan yang dipilih
        $jabatanLengkap = $request->jabatan_dasar;

        if ($request->jabatan_dasar === 'Kepala Bidang' && $request->filled('nama_bidang')) {
            $jabatanLengkap = 'Kepala Bidang ' . $request->nama_bidang;
        } elseif ($request->jabatan_dasar === 'Kasubag' && $request->filled('nama_subbag')) {
            $jabatanLengkap = 'Kasubag ' . $request->nama_subbag;
        } elseif ($request->jabatan_dasar === 'Kepala Seksi' && $request->filled('nama_seksi')) {
            $jabatanLengkap = 'Kepala Seksi ' . $request->nama_seksi;
        }

        $namaFoto = null;
        if ($request->hasFile('foto')) {
            Log::info('File foto ditemukan: ' . $request->file('foto')->getClientOriginalName());
            $path = $request->file('foto')->store('pejabat', 'public');
            $namaFoto = basename($path);
            Log::info('Foto disimpan sebagai: ' . $namaFoto);
        } else {
            Log::info('Tidak ada file foto yang diupload');
        }

        Pejabat::create([
            'nama' => $request->nama,
            'jabatan' => $jabatanLengkap,
            'nip' => $request->nip,
            'urutan' => $request->urutan,
            'foto' => $namaFoto,
            'status' => 'aktif', // Default status
        ]);

        // Log activity
        ActivityLog::createLog(
            'create',
            'Pejabat',
            Pejabat::latest()->first()->id,
            $request->nama
        );

        return redirect()->route('dashboard.pejabat.index')->with('success', 'Data pejabat baru berhasil ditambahkan!');
    }

    /**
 * Show the form for editing the specified resource.
 */
public function edit(Pejabat $pejabat)
{
    // Parse existing jabatan untuk menentukan jabatan dasar dan nama spesifik
    $jabatanDasar = $pejabat->jabatan;
    $namaBidang = null;
    $namaSubbag = null;
    $namaSeksi = null;

    // Cek apakah jabatan adalah Kepala Bidang
    if (str_starts_with($pejabat->jabatan, 'Kepala Bidang ')) {
        $jabatanDasar = 'Kepala Bidang';
        $namaBidang = str_replace('Kepala Bidang ', '', $pejabat->jabatan);
    }
    // Cek apakah jabatan adalah Kasubag
    elseif (str_starts_with($pejabat->jabatan, 'Kasubag ')) {
        $jabatanDasar = 'Kasubag';
        $namaSubbag = str_replace('Kasubag ', '', $pejabat->jabatan);
    }
    // Cek apakah jabatan adalah Kepala Seksi
    elseif (str_starts_with($pejabat->jabatan, 'Kepala Seksi ')) {
        $jabatanDasar = 'Kepala Seksi';
        $namaSeksi = str_replace('Kepala Seksi ', '', $pejabat->jabatan);
    }

    return view('admin.pejabat.edit', [
        'pejabat' => $pejabat,
        'jabatanDasar' => $jabatanDasar,
        'namaBidang' => $namaBidang,
        'namaSubbag' => $namaSubbag,
        'namaSeksi' => $namaSeksi,
    ]);
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, Pejabat $pejabat)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'jabatan_dasar' => 'required|string',
        'nama_bidang' => 'nullable|string|max:255',
        'nama_subbag' => 'nullable|string|max:255',
        'nama_seksi' => 'nullable|string|max:255',
        'nip' => 'nullable|string|max:255|unique:pejabats,nip,' . $pejabat->id,
        'urutan' => 'required|integer',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    // Gabungkan jabatan berdasarkan jenis jabatan yang dipilih
    $jabatanLengkap = $request->jabatan_dasar;

    if ($request->jabatan_dasar === 'Kepala Bidang' && $request->filled('nama_bidang')) {
        $jabatanLengkap = 'Kepala Bidang ' . $request->nama_bidang;
    } elseif ($request->jabatan_dasar === 'Kasubag' && $request->filled('nama_subbag')) {
        $jabatanLengkap = 'Kasubag ' . $request->nama_subbag;
    } elseif ($request->jabatan_dasar === 'Kepala Seksi' && $request->filled('nama_seksi')) {
        $jabatanLengkap = 'Kepala Seksi ' . $request->nama_seksi;
    }

    // Prepare data untuk update
    $data = [
        'nama' => $request->nama,
        'jabatan' => $jabatanLengkap,
        'nip' => $request->nip,
        'urutan' => $request->urutan,
        'status' => $request->get('status', 'aktif'), // Default status jika tidak ada
    ];

    // Handle file upload
    if ($request->hasFile('foto')) {
        Log::info('File foto ditemukan untuk update: ' . $request->file('foto')->getClientOriginalName());
        // Delete old photo if exists
        if ($pejabat->foto) {
            Storage::disk('public')->delete('pejabat/' . $pejabat->foto);
            Log::info('Foto lama dihapus: ' . $pejabat->foto);
        }
        $path = $request->file('foto')->store('pejabat', 'public');
        $data['foto'] = basename($path);
        Log::info('Foto baru disimpan sebagai: ' . basename($path));
    } else {
        Log::info('Tidak ada file foto yang diupload untuk update');
    }    $pejabat->update($data);

    // Log activity
    ActivityLog::createLog(
        'update',
        'Pejabat',
        $pejabat->id,
        $pejabat->nama
    );

    return redirect()->route('dashboard.pejabat.index')->with('success', 'Data pejabat berhasil diperbaharui!');
}
/**
 * Remove the specified resource from storage.
 */
public function destroy(Pejabat $pejabat)
{
    // Simpan data untuk logging sebelum dihapus
    $pejabatNama = $pejabat->nama;
    $pejabatId = $pejabat->id;

    // 1. Hapus file foto dari storage jika ada
    if ($pejabat->foto) {
        Storage::disk('public')->delete('pejabat/' . $pejabat->foto);
    }

    // 2. Hapus data pejabat dari database
    $pejabat->delete();

    // Log activity
    ActivityLog::createLog(
        'delete',
        'Pejabat',
        $pejabatId,
        $pejabatNama
    );

    // 3. Redirect kembali dengan pesan sukses
    return redirect()->route('dashboard.pejabat.index')->with('success', 'Data pejabat berhasil dihapus!');
}

public function __construct()
{
    $this->middleware('can:kelola pejabat');
}
}
