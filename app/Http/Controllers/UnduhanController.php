<?php

namespace App\Http\Controllers;

use App\Models\Unduhan;
use Illuminate\Http\Request;

class UnduhanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        // Jika ada pencarian, filter berdasarkan judul atau deskripsi
        if ($search && trim($search)) {
            $semua_unduhan = Unduhan::where(function($query) use ($search) {
                $query->where('judul', 'LIKE', '%' . trim($search) . '%')
                      ->orWhere('deskripsi', 'LIKE', '%' . trim($search) . '%');
            })
            ->latest()
            ->paginate(10);
        } else {
            // Ambil semua data unduhan, urutkan dari yang terbaru, dan gunakan paginasi
            $semua_unduhan = Unduhan::latest()->paginate(10);
            $search = null; // Reset search jika kosong
        }

        return view('unduhan.index', [
            'semua_unduhan' => $semua_unduhan,
            'search' => $search
        ]);
    }
}
