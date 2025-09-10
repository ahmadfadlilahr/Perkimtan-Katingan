<?php

namespace App\Services;

use App\Models\Slide;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class SlideService
{
    /**
     * Get all slides with optional search, pagination, and sorting
     *
     * @param string|null $search
     * @param int $perPage
     * @param string $sort
     * @param string $order
     * @return LengthAwarePaginator
     */
    public function getAllSlides(?string $search = null, int $perPage = 10, string $sort = 'urutan', string $order = 'asc'): LengthAwarePaginator
    {
        $query = Slide::query();

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'LIKE', "%{$search}%")
                  ->orWhere('subjudul', 'LIKE', "%{$search}%")
                  ->orWhere('tombol_teks', 'LIKE', "%{$search}%");
            });
        }

        // Apply sorting
        $allowedSortFields = ['id', 'judul', 'urutan', 'status', 'created_at', 'updated_at'];
        if (!in_array($sort, $allowedSortFields)) {
            $sort = 'urutan';
        }

        $allowedOrders = ['asc', 'desc'];
        if (!in_array($order, $allowedOrders)) {
            $order = 'asc';
        }

        return $query->orderBy($sort, $order)->paginate($perPage);
    }

    /**
     * Get active slides for public display
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getActiveSlides(int $perPage = 10): LengthAwarePaginator
    {
        return Slide::where('status', 'active')
            ->orderBy('urutan', 'asc')
            ->paginate($perPage);
    }

    /**
     * Create a new slide
     *
     * @param array $data
     * @return Slide
     */
    public function createSlide(array $data): Slide
    {
        // Handle image upload
        if (isset($data['gambar']) && $data['gambar'] instanceof UploadedFile) {
            $data['gambar'] = $this->handleImageUpload($data['gambar']);
        }

        // Set default urutan if not provided
        if (!isset($data['urutan'])) {
            $maxUrutan = Slide::max('urutan') ?? 0;
            $data['urutan'] = $maxUrutan + 1;
        }

        // Set default status if not provided
        if (!isset($data['status'])) {
            $data['status'] = 'active';
        }

        return Slide::create($data);
    }

    /**
     * Update an existing slide
     *
     * @param Slide $slide
     * @param array $data
     * @return Slide
     */
    public function updateSlide(Slide $slide, array $data): Slide
    {
        // Handle image upload
        if (isset($data['gambar']) && $data['gambar'] instanceof UploadedFile) {
            // Delete old image if exists
            if ($slide->gambar) {
                $this->deleteImage($slide->gambar);
            }

            $data['gambar'] = $this->handleImageUpload($data['gambar']);
        }

        $slide->update($data);
        return $slide->fresh();
    }

    /**
     * Delete a slide
     *
     * @param Slide $slide
     * @return bool
     */
    public function deleteSlide(Slide $slide): bool
    {
        // Delete associated image
        if ($slide->gambar) {
            $this->deleteImage($slide->gambar);
        }

        return $slide->delete();
    }

    /**
     * Reorder slides positions
     *
     * @param array $orderData Array with 'id' and 'urutan' pairs
     * @return bool
     */
    public function reorderSlides(array $orderData): bool
    {
        try {
            foreach ($orderData as $order) {
                if (isset($order['id']) && isset($order['urutan'])) {
                    Slide::where('id', $order['id'])->update(['urutan' => $order['urutan']]);
                }
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Toggle slide status
     *
     * @param Slide $slide
     * @return Slide
     */
    public function toggleStatus(Slide $slide): Slide
    {
        $newStatus = $slide->status === 'active' ? 'inactive' : 'active';
        $slide->update(['status' => $newStatus]);
        return $slide->fresh();
    }

    /**
     * Get slides by status
     *
     * @param string $status
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getSlidesByStatus(string $status, int $perPage = 10): LengthAwarePaginator
    {
        return Slide::where('status', $status)
            ->orderBy('urutan', 'asc')
            ->paginate($perPage);
    }

    /**
     * Handle image upload
     *
     * @param UploadedFile $file
     * @return string
     */
    private function handleImageUpload(UploadedFile $file): string
    {
        $path = $file->store('slide', 'public');
        return basename($path);
    }

    /**
     * Delete image from storage
     *
     * @param string $imageName
     * @return void
     */
    private function deleteImage(string $imageName): void
    {
        if (Storage::disk('public')->exists('slide/' . $imageName)) {
            Storage::disk('public')->delete('slide/' . $imageName);
        }
    }

    /**
     * Get slide statistics
     *
     * @return array
     */
    public function getSlideStats(): array
    {
        return [
            'total_slides' => Slide::count(),
            'active_slides' => Slide::where('status', 'active')->count(),
            'inactive_slides' => Slide::where('status', 'inactive')->count(),
        ];
    }
}
