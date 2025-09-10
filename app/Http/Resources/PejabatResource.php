<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="PejabatResource",
 *     type="object",
 *     title="Pejabat Resource",
 *     description="Pejabat resource representation",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nama", type="string", example="Dr. John Doe, M.T."),
 *     @OA\Property(property="jabatan", type="string", example="Kepala Dinas Perumahan dan Kawasan Permukiman"),
 *     @OA\Property(property="nip", type="string", nullable=true, example="197001011990011001"),
 *     @OA\Property(property="foto", type="string", nullable=true, example="http://localhost:8000/storage/pejabat/john-doe.jpg"),
 *     @OA\Property(property="foto_name", type="string", nullable=true, example="john-doe.jpg"),
 *     @OA\Property(property="urutan", type="integer", example=1),
 *     @OA\Property(property="created_at", type="string", format="datetime", example="2024-01-15 10:30:00"),
 *     @OA\Property(property="updated_at", type="string", format="datetime", example="2024-01-15 10:30:00")
 * )
 */
class PejabatResource extends JsonResource
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
            'nama' => $this->nama,
            'jabatan' => $this->jabatan,
            'nip' => $this->nip,
            'foto' => $this->foto ? asset('storage/pejabat/' . $this->foto) : null,
            'foto_name' => $this->foto,
            'urutan' => $this->urutan,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
