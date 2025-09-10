<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGaleriRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authorization handled by middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'keterangan' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'gambar.required' => 'Gambar wajib diupload.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Gambar harus berformat: jpeg, png, jpg, atau webp.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'keterangan.max' => 'Keterangan maksimal 255 karakter.',
        ];
    }
}
