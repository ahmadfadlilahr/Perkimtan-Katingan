<?php

namespace App\Services;

use App\Models\Unduhan;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class UnduhanService
{
    /**
     * Get all unduhan with optional search, pagination, and sorting
     *
     * @param string|null $search
     * @param int $perPage
     * @param string $sort
     * @param string $order
     * @return LengthAwarePaginator
     */
    public function getAllUnduhan(?string $search = null, int $perPage = 10, string $sort = 'id', string $order = 'desc'): LengthAwarePaginator
    {
        $query = Unduhan::query();

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$search}%");
            });
        }

        // Apply sorting
        $allowedSortFields = ['id', 'judul', 'deskripsi', 'file', 'created_at', 'updated_at'];
        if (!in_array($sort, $allowedSortFields)) {
            $sort = 'id';
        }

        $allowedOrders = ['asc', 'desc'];
        if (!in_array($order, $allowedOrders)) {
            $order = 'desc';
        }

        return $query->orderBy($sort, $order)->paginate($perPage);
    }

    /**
     * Get all unduhan for public display
     *
     * @param string|null $search
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPublicUnduhan(?string $search = null, int $perPage = 10): LengthAwarePaginator
    {
        $query = Unduhan::query();

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$search}%");
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Create a new unduhan
     *
     * @param array $data
     * @return Unduhan
     */
    public function createUnduhan(array $data): Unduhan
    {
        // Handle file upload
        if (isset($data['file']) && $data['file'] instanceof UploadedFile) {
            $data['file'] = $this->handleFileUpload($data['file']);
        }

        return Unduhan::create($data);
    }

    /**
     * Update an existing unduhan
     *
     * @param Unduhan $unduhan
     * @param array $data
     * @return Unduhan
     */
    public function updateUnduhan(Unduhan $unduhan, array $data): Unduhan
    {
        // Handle file upload
        if (isset($data['file']) && $data['file'] instanceof UploadedFile) {
            // Delete old file if exists
            if ($unduhan->file) {
                $this->deleteFile($unduhan->file);
            }

            $data['file'] = $this->handleFileUpload($data['file']);
        }

        $unduhan->update($data);
        return $unduhan->fresh();
    }

    /**
     * Delete an unduhan
     *
     * @param Unduhan $unduhan
     * @return bool
     */
    public function deleteUnduhan(Unduhan $unduhan): bool
    {
        // Delete associated file
        if ($unduhan->file) {
            $this->deleteFile($unduhan->file);
        }

        return $unduhan->delete();
    }

    /**
     * Download file
     *
     * @param Unduhan $unduhan
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|null
     */
    public function downloadFile(Unduhan $unduhan)
    {
        if (!$unduhan->file) {
            return null;
        }

        $filePath = 'unduhan/' . $unduhan->file;

        if (!Storage::disk('public')->exists($filePath)) {
            return null;
        }

        $fullPath = Storage::disk('public')->path($filePath);
        $originalName = $unduhan->judul . '.' . pathinfo($unduhan->file, PATHINFO_EXTENSION);

        return response()->download($fullPath, $originalName);
    }

    /**
     * Handle file upload
     *
     * @param UploadedFile $file
     * @return string
     */
    private function handleFileUpload(UploadedFile $file): string
    {
        $path = $file->store('unduhan', 'public');
        return basename($path);
    }

    /**
     * Delete file from storage
     *
     * @param string $fileName
     * @return void
     */
    private function deleteFile(string $fileName): void
    {
        if (Storage::disk('public')->exists('unduhan/' . $fileName)) {
            Storage::disk('public')->delete('unduhan/' . $fileName);
        }
    }

    /**
     * Get unduhan statistics
     *
     * @return array
     */
    public function getUnduhanStats(): array
    {
        $totalUnduhan = Unduhan::count();
        $totalFileSize = $this->calculateTotalFileSize();

        return [
            'total_unduhan' => $totalUnduhan,
            'total_file_size' => $totalFileSize,
            'total_file_size_human' => $this->formatBytes($totalFileSize),
        ];
    }

    /**
     * Calculate total file size of all unduhan files
     *
     * @return int
     */
    private function calculateTotalFileSize(): int
    {
        $totalSize = 0;
        $unduhans = Unduhan::whereNotNull('file')->get();

        foreach ($unduhans as $unduhan) {
            $filePath = 'unduhan/' . $unduhan->file;
            if (Storage::disk('public')->exists($filePath)) {
                $totalSize += Storage::disk('public')->size($filePath);
            }
        }

        return $totalSize;
    }

    /**
     * Format bytes to human readable format
     *
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    private function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
