<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSlideRequest extends FormRequest
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
            'judul' => ['required', 'string', 'max:255'],
            'subjudul' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'tombol_teks' => ['nullable', 'string', 'max:100'],
            'tombol_link' => ['nullable', 'url', 'max:255'],
            'gambar' => ['required', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:5120'], // 5MB max
            'urutan' => ['nullable', 'integer', 'min:1'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'judul.required' => 'Judul slide harus diisi.',
            'judul.max' => 'Judul slide maksimal 255 karakter.',
            'subjudul.max' => 'Subjudul maksimal 255 karakter.',
            'tombol_teks.max' => 'Teks tombol maksimal 100 karakter.',
            'tombol_link.url' => 'Link tombol harus berupa URL yang valid.',
            'tombol_link.max' => 'Link tombol maksimal 255 karakter.',
            'gambar.required' => 'Gambar slide harus diupload.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Gambar harus berformat: jpeg, jpg, png, gif, atau webp.',
            'gambar.max' => 'Ukuran gambar maksimal 5MB.',
            'urutan.integer' => 'Urutan harus berupa angka.',
            'urutan.min' => 'Urutan minimal 1.',
            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status harus active atau inactive.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'judul' => 'judul',
            'subjudul' => 'subjudul',
            'deskripsi' => 'deskripsi',
            'tombol_teks' => 'teks tombol',
            'tombol_link' => 'link tombol',
            'gambar' => 'gambar',
            'urutan' => 'urutan',
            'status' => 'status',
        ];
    }
}
