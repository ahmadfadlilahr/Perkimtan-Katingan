<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UnduhanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'file' => $this->when($this->file, function () {
                return [
                    'filename' => $this->file,
                    'original_name' => $this->judul . '.' . pathinfo($this->file, PATHINFO_EXTENSION),
                    'extension' => pathinfo($this->file, PATHINFO_EXTENSION),
                    'url' => asset('storage/unduhan/' . $this->file),
                    'download_url' => url('api/unduhan/' . $this->id . '/download'),
                    'size' => $this->getFileSize(),
                    'size_human' => $this->getFileSizeHuman(),
                ];
            }),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            'created_at_human' => $this->created_at?->diffForHumans(),
            'updated_at_human' => $this->updated_at?->diffForHumans(),
        ];
    }

    /**
     * Get file size in bytes
     *
     * @return int|null
     */
    private function getFileSize(): ?int
    {
        if (!$this->file) {
            return null;
        }

        $filePath = 'unduhan/' . $this->file;

        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->size($filePath);
        }

        return null;
    }

    /**
     * Get human readable file size
     *
     * @return string|null
     */
    private function getFileSizeHuman(): ?string
    {
        $size = $this->getFileSize();

        if ($size === null) {
            return null;
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $size > 1024; $i++) {
            $size /= 1024;
        }

        return round($size, 2) . ' ' . $units[$i];
    }
}
