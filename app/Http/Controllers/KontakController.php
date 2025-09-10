<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Rules\RecaptchaRule;
use App\Rules\MathCaptchaRule;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak.index');
    }

    /**
     * Menyimpan pesan baru dari form kontak publik.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk dari form
        $rules = [
            'nama_pengirim' => 'required|string|max:255',
            'email_pengirim' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'tipe_pesan' => 'required|string',
            'subjek' => 'required|string|max:255',
            'isi_pesan' => 'required|string',
        ];

        // Add CAPTCHA validation based on configuration
        if (config('services.recaptcha.site_key')) {
            // Use Google reCAPTCHA
            $rules['g-recaptcha-response'] = ['required', new RecaptchaRule()];
        } else {
            // Use Math CAPTCHA as fallback
            $rules['captcha_answer'] = ['required', new MathCaptchaRule()];
        }

        $request->validate($rules);

        // 2. Simpan data pesan ke database menggunakan Model Pesan
        Pesan::create([
            'nama_pengirim' => $request->nama_pengirim,
            'email_pengirim' => $request->email_pengirim,
            'telepon' => $request->telepon,
            'tipe_pesan' => $request->tipe_pesan,
            'subjek' => $request->subjek,
            'isi_pesan' => $request->isi_pesan,
            // Status akan otomatis 'Belum Dibaca' sesuai default di database
        ]);

        // 3. Kembali ke halaman kontak dengan pesan sukses
        return redirect()->route('kontak.public')->with('success', 'Pesan Anda telah berhasil dikirim. Terima kasih!');
    }
}
