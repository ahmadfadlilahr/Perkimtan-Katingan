<?php

namespace App\Services;

use App\Models\Galeri;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class GaleriService
{
    /**
     * Get all galleries with optional search and pagination
     */
    public function getAllGaleri($search = null, $perPage = 10, $sort = 'created_at', $order = 'desc')
    {
        $query = Galeri::query();

        if ($search) {
            $query->search($search);
        }

        // Validate sort field
        $allowedSortFields = ['id', 'keterangan', 'created_at', 'updated_at'];
        if (!in_array($sort, $allowedSortFields)) {
            $sort = 'created_at';
        }

        // Validate order direction
        $order = in_array(strtolower($order), ['asc', 'desc']) ? strtolower($order) : 'desc';

        return $query->orderBy($sort, $order)->paginate($perPage);
    }

    /**
     * Create new gallery
     */
    public function createGaleri(array $data)
    {
        if (isset($data['gambar']) && $data['gambar'] instanceof UploadedFile) {
            $data['gambar'] = $this->storeImage($data['gambar']);
        }

        return Galeri::create($data);
    }

    /**
     * Update gallery
     */
    public function updateGaleri(Galeri $galeri, array $data)
    {
        // Handle image upload
        if (isset($data['gambar']) && $data['gambar'] instanceof UploadedFile) {
            // Delete old image
            if ($galeri->gambar && Storage::disk('public')->exists('galeri/' . $galeri->gambar)) {
                Storage::disk('public')->delete('galeri/' . $galeri->gambar);
            }

            $data['gambar'] = $this->storeImage($data['gambar']);
        }

        $galeri->update($data);
        return $galeri->fresh();
    }

    /**
     * Delete gallery
     */
    public function deleteGaleri(Galeri $galeri)
    {
        // Delete image file
        if ($galeri->gambar && Storage::disk('public')->exists('galeri/' . $galeri->gambar)) {
            Storage::disk('public')->delete('galeri/' . $galeri->gambar);
        }

        return $galeri->delete();
    }

    /**
     * Store image file
     */
    private function storeImage(UploadedFile $file): string
    {
        $month = date('Ym');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->storeAs('galeri/' . $month, $filename, 'public');

        return $month . '/' . $filename;
    }
}
