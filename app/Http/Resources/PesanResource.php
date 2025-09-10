<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="PesanResource",
 *     type="object",
 *     title="Pesan Resource",
 *     description="Pesan resource representation",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nama_pengirim", type="string", example="John Doe"),
 *     @OA\Property(property="email_pengirim", type="string", example="john.doe@example.com"),
 *     @OA\Property(property="telepon", type="string", nullable=true, example="081234567890"),
 *     @OA\Property(property="tipe_pesan", type="string", enum={"pengaduan", "pertanyaan", "saran", "lainnya"}, example="pertanyaan"),
 *     @OA\Property(property="subjek", type="string", example="Pertanyaan tentang perizinan bangunan"),
 *     @OA\Property(property="isi_pesan", type="string", example="Saya ingin bertanya tentang prosedur perizinan bangunan..."),
 *     @OA\Property(property="lampiran", type="string", nullable=true, example="http://localhost:8000/storage/pesan/document.pdf"),
 *     @OA\Property(property="lampiran_name", type="string", nullable=true, example="document.pdf"),
 *     @OA\Property(property="status", type="string", enum={"unread", "read", "replied"}, example="unread"),
 *     @OA\Property(property="created_at", type="string", format="datetime", example="2024-01-15 10:30:00"),
 *     @OA\Property(property="updated_at", type="string", format="datetime", example="2024-01-15 10:30:00")
 * )
 */
class PesanResource extends JsonResource
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
            'nama_pengirim' => $this->nama_pengirim,
            'email_pengirim' => $this->email_pengirim,
            'telepon' => $this->telepon,
            'tipe_pesan' => $this->tipe_pesan,
            'subjek' => $this->subjek,
            'isi_pesan' => $this->isi_pesan,
            'lampiran' => $this->lampiran ? asset('storage/pesan/' . $this->lampiran) : null,
            'lampiran_name' => $this->lampiran,
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
