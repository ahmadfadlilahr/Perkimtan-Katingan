<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\VisiMisi;
use App\Services\VisiMisiService;

class ProfilController extends Controller
{
    protected VisiMisiService $visiMisiService;

    public function __construct(VisiMisiService $visiMisiService)
    {
        $this->visiMisiService = $visiMisiService;
    }

    /**
     * Menampilkan halaman visi dan misi (dynamic from database)
     */
    public function visiMisi()
    {
        try {
            // Get only visi and misi data (optimized for public page)
            $visiMisiData = $this->visiMisiService->getPublicVisiMisi();

            // Extract each type
            $visiItems = $visiMisiData[VisiMisi::TYPE_VISI]['items'] ?? collect();
            $misiItems = $visiMisiData[VisiMisi::TYPE_MISI]['items'] ?? collect();

            return view('profil.visi-misi', compact(
                'visiItems',
                'misiItems'
            ));
        } catch (\Exception $e) {
            // If there's an error, fall back to the original static view
            Log::error('Error loading dynamic visi misi: ' . $e->getMessage());

            return view('profil.visi-misi', [
                'visiItems' => collect(),
                'misiItems' => collect()
            ]);
        }
    }
}
