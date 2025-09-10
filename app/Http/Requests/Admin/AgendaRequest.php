<?php

namespace App\Http\Requests\Admin;

use App\Models\Agenda;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="AgendaRequest",
 *     title="Agenda Request",
 *     description="Schema untuk request data agenda",
 *     required={"judul", "konten", "tanggal_agenda", "kategori", "prioritas", "status"},
 *     @OA\Property(property="judul", type="string", maxLength=255, example="Rapat Koordinasi Pembangunan Infrastruktur"),
 *     @OA\Property(property="konten", type="string", example="Agenda ini akan membahas progress pembangunan infrastruktur di wilayah kecamatan..."),
 *     @OA\Property(property="tanggal_agenda", type="string", format="date", example="2025-08-25"),
 *     @OA\Property(property="waktu_mulai", type="string", format="time", example="09:00", nullable=true),
 *     @OA\Property(property="waktu_selesai", type="string", format="time", example="11:00", nullable=true),
 *     @OA\Property(property="lokasi", type="string", maxLength=255, example="Ruang Meeting Dinas", nullable=true),
 *     @OA\Property(property="penyelenggara", type="string", maxLength=255, example="Bagian Perencanaan", nullable=true),
 *     @OA\Property(property="gambar", type="string", format="binary", description="File gambar (jpeg,png,jpg,gif,webp), max 2MB", nullable=true),
 *     @OA\Property(property="lampiran", type="string", format="binary", description="File lampiran (pdf,doc,docx,xls,xlsx,ppt,pptx), max 5MB", nullable=true),
 *     @OA\Property(property="kategori", type="string", enum={"rapat", "sosialisasi", "workshop", "acara_publik"}, example="rapat"),
 *     @OA\Property(property="prioritas", type="string", enum={"rendah", "sedang", "tinggi", "mendesak"}, example="tinggi"),
 *     @OA\Property(property="status", type="string", enum={"draft", "published", "selesai", "dibatalkan"}, example="published"),
 *     @OA\Property(property="is_featured", type="boolean", example=false, nullable=true),
 *     @OA\Property(property="is_publik", type="boolean", example=true, nullable=true)
 * )
 */
class AgendaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $agendaId = $this->route('agenda')?->id;

        return [
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal_agenda' => 'required|date|after_or_equal:today',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i|after:waktu_mulai',
            'lokasi' => 'nullable|string|max:255',
            'penyelenggara' => 'nullable|string|max:255',
            'gambar' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:2048' // 2MB
            ],
            'lampiran' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
                'max:5120' // 5MB
            ],
            'kategori' => [
                'required',
                Rule::in(array_keys(Agenda::getKategoriOptions()))
            ],
            'prioritas' => [
                'required',
                Rule::in(array_keys(Agenda::getPrioritasOptions()))
            ],
            'status' => [
                'required',
                Rule::in(array_keys(Agenda::getStatusOptions()))
            ],
            'is_featured' => 'boolean',
            'is_publik' => 'boolean',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'judul' => 'judul agenda',
            'konten' => 'konten agenda',
            'tanggal_agenda' => 'tanggal agenda',
            'waktu_mulai' => 'waktu mulai',
            'waktu_selesai' => 'waktu selesai',
            'lokasi' => 'lokasi',
            'penyelenggara' => 'penyelenggara',
            'gambar' => 'gambar',
            'lampiran' => 'lampiran',
            'kategori' => 'kategori',
            'prioritas' => 'prioritas',
            'status' => 'status',
            'is_featured' => 'agenda unggulan',
            'is_publik' => 'agenda publik',
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'judul.required' => 'Judul agenda wajib diisi.',
            'judul.max' => 'Judul agenda maksimal 255 karakter.',
            'konten.required' => 'Konten agenda wajib diisi.',
            'tanggal_agenda.required' => 'Tanggal agenda wajib diisi.',
            'tanggal_agenda.after_or_equal' => 'Tanggal agenda tidak boleh kurang dari hari ini.',
            'waktu_mulai.date_format' => 'Format waktu mulai harus HH:MM.',
            'waktu_selesai.date_format' => 'Format waktu selesai harus HH:MM.',
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Gambar harus berformat: jpeg, png, jpg, gif, webp.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'lampiran.mimes' => 'Lampiran harus berformat: pdf, doc, docx, xls, xlsx, ppt, pptx.',
            'lampiran.max' => 'Ukuran lampiran maksimal 5MB.',
            'kategori.required' => 'Kategori agenda wajib dipilih.',
            'kategori.in' => 'Kategori yang dipilih tidak valid.',
            'prioritas.required' => 'Prioritas agenda wajib dipilih.',
            'prioritas.in' => 'Prioritas yang dipilih tidak valid.',
            'status.required' => 'Status agenda wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Convert checkbox values to boolean
        $this->merge([
            'is_featured' => $this->boolean('is_featured'),
            'is_publik' => $this->boolean('is_publik'),
        ]);

        // Remove file fields if they're empty strings
        if ($this->gambar === '') {
            $this->request->remove('gambar');
        }

        if ($this->lampiran === '') {
            $this->request->remove('lampiran');
        }
    }
}
