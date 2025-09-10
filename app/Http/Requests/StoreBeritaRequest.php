<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBeritaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Akan dihandle oleh middleware auth:sanctum
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255',
            'penulis' => 'nullable|string|max:255', // Made optional, will use authenticated user
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:published,draft',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'judul.required' => 'Judul berita wajib diisi.',
            'judul.max' => 'Judul berita tidak boleh lebih dari 255 karakter.',
            'penulis.max' => 'Nama penulis tidak boleh lebih dari 255 karakter.',
            'isi.required' => 'Konten berita wajib diisi.',
            'gambar.image' => 'File yang diupload harus berupa gambar.',
            'gambar.mimes' => 'Format gambar yang didukung: jpeg, png, jpg, webp.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'status.required' => 'Status publikasi wajib dipilih.',
            'status.in' => 'Status publikasi harus berupa published atau draft.',
        ];
    }
}
