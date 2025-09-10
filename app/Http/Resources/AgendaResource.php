<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="AgendaResource",
 *     title="Agenda Resource",
 *     description="Resource untuk menampilkan data agenda",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="judul", type="string", example="Rapat Koordinasi Pembangunan Infrastruktur"),
 *     @OA\Property(property="slug", type="string", example="rapat-koordinasi-pembangunan-infrastruktur"),
 *     @OA\Property(property="konten", type="string", example="Agenda ini akan membahas progress pembangunan infrastruktur di wilayah kecamatan..."),
 *     @OA\Property(property="tanggal_agenda", type="string", format="date", example="2025-08-25"),
 *     @OA\Property(property="waktu_mulai", type="string", format="time", example="09:00"),
 *     @OA\Property(property="waktu_selesai", type="string", format="time", example="11:00"),
 *     @OA\Property(property="lokasi", type="string", example="Ruang Meeting Dinas"),
 *     @OA\Property(property="penyelenggara", type="string", example="Bagian Perencanaan"),
 *     @OA\Property(property="kategori", type="string", enum={"rapat", "sosialisasi", "workshop", "acara_publik"}, example="rapat"),
 *     @OA\Property(property="kategori_label", type="string", example="Rapat"),
 *     @OA\Property(property="status", type="string", enum={"draft", "published", "selesai", "dibatalkan"}, example="published"),
 *     @OA\Property(property="status_label", type="string", example="Published"),
 *     @OA\Property(property="prioritas", type="string", enum={"rendah", "sedang", "tinggi", "mendesak"}, example="tinggi"),
 *     @OA\Property(property="prioritas_label", type="string", example="Tinggi"),
 *     @OA\Property(property="is_publik", type="boolean", example=true),
 *     @OA\Property(property="is_featured", type="boolean", example=false),
 *     @OA\Property(property="gambar", type="string", nullable=true, example="http://example.com/storage/agenda/image.jpg"),
 *     @OA\Property(property="lampiran", type="string", nullable=true, example="http://example.com/storage/agenda/document.pdf"),
 *     @OA\Property(property="nama_lampiran", type="string", nullable=true, example="Dokumen Lampiran.pdf"),
 *     @OA\Property(property="tanggal_agenda_formatted", type="string", example="25 Agustus 2025"),
 *     @OA\Property(property="waktu_agenda_formatted", type="string", example="09:00 - 11:00"),
 *     @OA\Property(
 *         property="created_by",
 *         type="object",
 *         @OA\Property(property="id", type="integer", example=1),
 *         @OA\Property(property="name", type="string", example="Admin User"),
 *         @OA\Property(property="email", type="string", example="admin@example.com")
 *     ),
 *     @OA\Property(property="created_at", type="string", format="datetime", example="2025-08-23T10:00:00.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="datetime", example="2025-08-23T10:00:00.000000Z")
 * )
 */
class AgendaResource extends JsonResource
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
            'slug' => $this->slug,
            'konten' => $this->konten,
            'tanggal_agenda' => $this->tanggal_agenda,
            'waktu_mulai' => $this->waktu_mulai,
            'waktu_selesai' => $this->waktu_selesai,
            'lokasi' => $this->lokasi,
            'penyelenggara' => $this->penyelenggara,
            'kategori' => $this->kategori,
            'kategori_label' => $this->kategori_label,
            'status' => $this->status,
            'status_label' => $this->status_label,
            'prioritas' => $this->prioritas,
            'prioritas_label' => $this->prioritas_label,
            'is_publik' => $this->is_publik,
            'is_featured' => $this->is_featured,
            'gambar' => $this->gambar ? asset('storage/' . $this->gambar) : null,
            'lampiran' => $this->lampiran ? asset('storage/' . $this->lampiran) : null,
            'nama_lampiran' => $this->nama_lampiran,
            'tanggal_agenda_formatted' => $this->tanggal_agenda_formatted,
            'waktu_agenda_formatted' => $this->waktu_agenda_formatted,
            'created_by' => [
                'id' => $this->user?->id,
                'name' => $this->user?->name,
                'email' => $this->user?->email,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
