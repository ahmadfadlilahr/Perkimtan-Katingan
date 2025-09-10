<?php

namespace App\Http\Requests;

use App\Rules\RecaptchaRule;
use App\Rules\MathCaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePesanRequest extends FormRequest
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
        $rules = [
            'nama_pengirim' => 'required|string|max:255',
            'email_pengirim' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'tipe_pesan' => 'required|in:Pengaduan,Permohonan,Informasi',
            'subjek' => 'required|string|max:255',
            'isi_pesan' => 'required|string|max:5000', // Limit content length
            'status' => 'nullable|in:unread,read,replied',
            // Honeypot field - should be empty
            'website' => 'nullable|max:0',
        ];

        // Add CAPTCHA validation based on configuration
        if (config('services.recaptcha.site_key')) {
            // Use Google reCAPTCHA
            $rules['g-recaptcha-response'] = ['required', new RecaptchaRule()];
        } else {
            // Use Math CAPTCHA as fallback
            $rules['captcha_answer'] = ['required', new MathCaptchaRule()];
        }

        return $rules;
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
            'tipe_pesan.in' => 'Tipe pesan harus berupa Pengaduan, Permohonan, atau Informasi.',
            'subjek.required' => 'Subjek pesan harus diisi.',
            'subjek.max' => 'Subjek tidak boleh lebih dari 255 karakter.',
            'isi_pesan.required' => 'Isi pesan harus diisi.',
            'isi_pesan.max' => 'Isi pesan tidak boleh lebih dari 5000 karakter.',
            'g-recaptcha-response.required' => 'Verifikasi reCAPTCHA harus dilakukan.',
            'captcha_answer.required' => 'Jawaban CAPTCHA harus diisi.',
            'status.in' => 'Status harus berupa unread, read, atau replied.',
            'website.max' => 'Field website harus kosong.',
        ];
    }
}
