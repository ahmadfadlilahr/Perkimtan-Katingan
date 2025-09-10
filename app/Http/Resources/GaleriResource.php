<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="GaleriResource",
 *     type="object",
 *     title="Gallery Resource",
 *     description="Gallery resource representation",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="gambar", type="string", example="202401/1705123456_unique123.jpg"),
 *     @OA\Property(property="keterangan", type="string", example="Foto kegiatan gotong royong di kampung"),
 *     @OA\Property(property="image_url", type="string", example="http://localhost:8000/storage/galeri/202401/1705123456_unique123.jpg"),
 *     @OA\Property(property="created_at", type="string", format="datetime", example="2024-01-15T10:30:00.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="datetime", example="2024-01-15T10:30:00.000000Z")
 * )
 */
class GaleriResource extends JsonResource
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
            'gambar' => $this->gambar,
            'keterangan' => $this->keterangan,
            'image_url' => $this->image_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
