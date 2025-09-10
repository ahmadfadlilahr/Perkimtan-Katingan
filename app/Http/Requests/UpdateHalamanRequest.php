<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHalamanRequest extends FormRequest
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
        $halamanId = $this->route('halaman') ?? $this->route('id');

        return [
            'judul' => 'required|string|max:255|unique:halamans,judul,' . $halamanId,
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:published,draft',
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
            'judul.required' => 'Judul halaman harus diisi.',
            'judul.max' => 'Judul halaman tidak boleh lebih dari 255 karakter.',
            'judul.unique' => 'Judul halaman sudah ada, gunakan judul yang berbeda.',
            'konten.required' => 'Konten halaman harus diisi.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau webp.',
            'gambar.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'status.required' => 'Status halaman harus dipilih.',
            'status.in' => 'Status halaman harus berupa published atau draft.',
        ];
    }
}
