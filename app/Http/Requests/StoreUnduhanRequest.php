<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnduhanRequest extends FormRequest
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
            'deskripsi' => ['nullable', 'string'],
            'file' => ['required', 'file', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,txt', 'max:10240'], // 10MB max
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
            'judul.required' => 'Judul file harus diisi.',
            'judul.max' => 'Judul file maksimal 255 karakter.',
            'file.required' => 'File harus diupload.',
            'file.file' => 'File yang diupload tidak valid.',
            'file.mimes' => 'File harus berformat: pdf, doc, docx, xls, xlsx, ppt, pptx, zip, rar, atau txt.',
            'file.max' => 'Ukuran file maksimal 10MB.',
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
            'deskripsi' => 'deskripsi',
            'file' => 'file',
        ];
    }
}
