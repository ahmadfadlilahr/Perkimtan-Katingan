<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePejabatRequest extends FormRequest
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
        $pejabatId = $this->route('pejabat') ?? $this->route('id');

        return [
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50|unique:pejabats,nip,' . $pejabatId,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'urutan' => 'nullable|integer|min:1',
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
            'nama.required' => 'Nama pejabat harus diisi.',
            'nama.max' => 'Nama pejabat tidak boleh lebih dari 255 karakter.',
            'jabatan.required' => 'Jabatan harus diisi.',
            'jabatan.max' => 'Jabatan tidak boleh lebih dari 255 karakter.',
            'nip.max' => 'NIP tidak boleh lebih dari 50 karakter.',
            'nip.unique' => 'NIP sudah digunakan oleh pejabat lain.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpeg, png, jpg, atau webp.',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
            'urutan.integer' => 'Urutan harus berupa angka.',
            'urutan.min' => 'Urutan harus minimal 1.',
        ];
    }
}
