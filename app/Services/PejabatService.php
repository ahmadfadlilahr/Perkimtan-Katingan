<?php

namespace App\Services;

use App\Models\Pejabat;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class PejabatService
{
    /**
     * Get all pejabat with optional search, pagination, and sorting
     *
     * @param string|null $search
     * @param int $perPage
     * @param string $sort
     * @param string $order
     * @return LengthAwarePaginator
     */
    public function getAllPejabat(?string $search = null, int $perPage = 10, string $sort = 'urutan', string $order = 'asc'): LengthAwarePaginator
    {
        $query = Pejabat::query();

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('jabatan', 'LIKE', "%{$search}%")
                  ->orWhere('nip', 'LIKE', "%{$search}%");
            });
        }

        // Apply sorting
        $allowedSortFields = ['id', 'nama', 'jabatan', 'nip', 'urutan', 'created_at', 'updated_at'];
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
     * Create a new pejabat
     *
     * @param array $data
     * @return Pejabat
     */
    public function createPejabat(array $data): Pejabat
    {
        // Handle image upload
        if (isset($data['foto']) && $data['foto'] instanceof UploadedFile) {
            $data['foto'] = $this->handleImageUpload($data['foto']);
        }

        // Set default urutan if not provided
        if (!isset($data['urutan'])) {
            $maxUrutan = Pejabat::max('urutan') ?? 0;
            $data['urutan'] = $maxUrutan + 1;
        }

        return Pejabat::create($data);
    }

    /**
     * Update an existing pejabat
     *
     * @param Pejabat $pejabat
     * @param array $data
     * @return Pejabat
     */
    public function updatePejabat(Pejabat $pejabat, array $data): Pejabat
    {
        // Handle image upload
        if (isset($data['foto']) && $data['foto'] instanceof UploadedFile) {
            // Delete old image if exists
            if ($pejabat->foto) {
                $this->deleteImage($pejabat->foto);
            }

            $data['foto'] = $this->handleImageUpload($data['foto']);
        }

        $pejabat->update($data);
        return $pejabat->fresh();
    }

    /**
     * Delete a pejabat
     *
     * @param Pejabat $pejabat
     * @return bool
     */
    public function deletePejabat(Pejabat $pejabat): bool
    {
        // Delete associated image
        if ($pejabat->foto) {
            $this->deleteImage($pejabat->foto);
        }

        return $pejabat->delete();
    }

    /**
     * Get pejabat ordered by urutan (for public display)
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPejabatByOrder(int $perPage = 10): LengthAwarePaginator
    {
        return Pejabat::orderBy('urutan', 'asc')
            ->orderBy('nama', 'asc')
            ->paginate($perPage);
    }

    /**
     * Reorder pejabat positions
     *
     * @param array $orderData Array with 'id' and 'urutan' pairs
     * @return bool
     */
    public function reorderPejabat(array $orderData): bool
    {
        try {
            foreach ($orderData as $order) {
                if (isset($order['id']) && isset($order['urutan'])) {
                    Pejabat::where('id', $order['id'])->update(['urutan' => $order['urutan']]);
                }
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Handle image upload
     *
     * @param UploadedFile $file
     * @return string
     */
    private function handleImageUpload(UploadedFile $file): string
    {
        $path = $file->store('pejabat', 'public');
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
        if (Storage::disk('public')->exists('pejabat/' . $imageName)) {
            Storage::disk('public')->delete('pejabat/' . $imageName);
        }
    }

    /**
     * Get pejabat statistics
     *
     * @return array
     */
    public function getPejabatStats(): array
    {
        return [
            'total_pejabat' => Pejabat::count(),
            'latest_pejabat' => Pejabat::latest()->first(),
        ];
    }
}
