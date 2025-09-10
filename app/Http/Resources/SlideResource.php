<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SlideResource extends JsonResource
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
            'subjudul' => $this->subjudul,
            'deskripsi' => $this->deskripsi,
            'tombol_teks' => $this->tombol_teks,
            'tombol_link' => $this->tombol_link,
            'gambar' => $this->when($this->gambar, function () {
                return [
                    'filename' => $this->gambar,
                    'url' => asset('storage/slide/' . $this->gambar),
                    'full_url' => url('storage/slide/' . $this->gambar),
                ];
            }),
            'urutan' => $this->urutan,
            'status' => $this->status,
            'status_label' => $this->status === 'active' ? 'Aktif' : 'Tidak Aktif',
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            'created_at_human' => $this->created_at?->diffForHumans(),
            'updated_at_human' => $this->updated_at?->diffForHumans(),
        ];
    }
}
