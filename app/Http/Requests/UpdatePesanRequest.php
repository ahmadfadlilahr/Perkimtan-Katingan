<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePesanRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_pengirim' => 'required|string|max:255',
            'email_pengirim' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'tipe_pesan' => 'required|in:pengaduan,pertanyaan,saran,lainnya',
            'subjek' => 'required|string|max:255',
            'isi_pesan' => 'required|string',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120', // Max 5MB
            'status' => 'required|in:unread,read,replied',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama_pengirim.required' => 'Nama pengirim harus diisi.',
            'nama_pengirim.max' => 'Nama pengirim tidak boleh lebih dari 255 karakter.',
            'email_pengirim.required' => 'Email pengirim harus diisi.',
            'email_pengirim.email' => 'Format email tidak valid.',
            'email_pengirim.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'telepon.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter.',
            'tipe_pesan.required' => 'Tipe pesan harus dipilih.',
            'tipe_pesan.in' => 'Tipe pesan harus berupa pengaduan, pertanyaan, saran, atau lainnya.',
            'subjek.required' => 'Subjek pesan harus diisi.',
            'subjek.max' => 'Subjek tidak boleh lebih dari 255 karakter.',
            'isi_pesan.required' => 'Isi pesan harus diisi.',
            'lampiran.file' => 'Lampiran harus berupa file.',
            'lampiran.mimes' => 'Lampiran harus berformat PDF, DOC, DOCX, JPG, JPEG, atau PNG.',
            'lampiran.max' => 'Ukuran lampiran tidak boleh lebih dari 5MB.',
            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status harus berupa unread, read, atau replied.',
        ];
    }
}
