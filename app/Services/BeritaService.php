<?php

namespace App\Services;

use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class BeritaService
{
    /**
     * Get all berita with filters and pagination
     */
    public function getAllBerita(array $filters = [], int $perPage = 10)
    {
        $query = Berita::latest();

        // Filter by status
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        // Search by title, author, or content
        if (isset($filters['search'])) {
            $searchTerm = $filters['search'];
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('penulis', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('isi', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        return $query->paginate($perPage);
    }

    /**
     * Get berita by slug
     */
    public function getBeritaBySlug(string $slug, bool $publishedOnly = true)
    {
        $query = Berita::where('slug', $slug);

        if ($publishedOnly) {
            $query->where('status', 'published');
        }

        return $query->firstOrFail();
    }

    /**
     * Get berita by ID
     */
    public function getBeritaById(int $id)
    {
        return Berita::findOrFail($id);
    }

    /**
     * Create new berita
     */
    public function createBerita(array $data, $imageFile = null)
    {
        // Handle image upload
        $imageName = null;
        if ($imageFile) {
            Log::info('Berita - File gambar ditemukan: ' . $imageFile->getClientOriginalName());
            $path = $imageFile->store('berita', 'public');
            $imageName = basename($path);
            Log::info('Berita - Gambar disimpan sebagai: ' . $imageName);
        } else {
            Log::info('Berita - Tidak ada file gambar yang diupload');
        }

        // Prepare data
        $beritaData = [
            'judul' => $data['judul'],
            'slug' => Str::slug($data['judul']),
            'penulis' => $data['penulis'],
            'isi' => $data['isi'],
            'gambar' => $imageName,
            'status' => $data['status'],
            'published_at' => $data['status'] === 'published' ? now() : null,
        ];

        return Berita::create($beritaData);
    }

    /**
     * Update existing berita
     */
    public function updateBerita(Berita $berita, array $data, $imageFile = null)
    {
        // Prepare update data
        $updateData = [
            'judul' => $data['judul'],
            'slug' => Str::slug($data['judul']),
            'penulis' => $data['penulis'],
            'isi' => $data['isi'],
            'status' => $data['status'],
            'published_at' => $data['status'] === 'published' ? now() : null,
        ];

        // Handle image upload
        if ($imageFile) {
            Log::info('Berita Update - File gambar ditemukan: ' . $imageFile->getClientOriginalName());
            // Delete old image
            if ($berita->gambar) {
                Storage::disk('public')->delete('berita/' . $berita->gambar);
                Log::info('Berita Update - Gambar lama dihapus: ' . $berita->gambar);
            }

            $path = $imageFile->store('berita', 'public');
            $updateData['gambar'] = basename($path);
            Log::info('Berita Update - Gambar baru disimpan sebagai: ' . basename($path));
        } else {
            Log::info('Berita Update - Tidak ada file gambar yang diupload untuk update');
        }

        $berita->update($updateData);
        return $berita->fresh();
    }

    /**
     * Delete berita
     */
    public function deleteBerita(Berita $berita)
    {
        // Delete image file
        if ($berita->gambar) {
            Storage::disk('public')->delete('berita/' . $berita->gambar);
        }

        return $berita->delete();
    }

    /**
     * Get published berita for public
     */
    public function getPublishedBerita(int $perPage = 10)
    {
        return Berita::where('status', 'published')
            ->latest('published_at')
            ->paginate($perPage);
    }

    /**
     * Search published berita for public
     */
    public function searchPublishedBerita(string $search, int $perPage = 10)
    {
        return Berita::where('status', 'published')
            ->where(function($query) use ($search) {
                $query->where('judul', 'LIKE', '%' . $search . '%')
                      ->orWhere('penulis', 'LIKE', '%' . $search . '%')
                      ->orWhere('isi', 'LIKE', '%' . $search . '%');
            })
            ->latest('published_at')
            ->paginate($perPage);
    }

    /**
     * Get dashboard statistics
     */
    public function getDashboardStats()
    {
        return [
            'total_berita' => Berita::count(),
            'published_berita' => Berita::where('status', 'published')->count(),
            'draft_berita' => Berita::where('status', 'draft')->count(),
            'recent_berita' => Berita::latest()->limit(5)->get(),
        ];
    }
}
