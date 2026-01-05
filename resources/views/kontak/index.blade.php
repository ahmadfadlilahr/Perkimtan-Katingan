@extends('layouts.public')

@section('content')
<div class="bg-gradient-to-br from-gray-50 via-white to-indigo-50 py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">

        {{-- Static Header Section --}}
        <x-ui.section-header
            badge="✉️ Hubungi Kami"
            badgeVariant="info"
            title="Mari Terhubung Bersama"
            subtitle="Kami siap membantu Anda dengan pelayanan terbaik. Jangan ragu untuk menghubungi kami melalui berbagai cara di bawah ini."
            :animated="false" />

        {{-- Main Content Grid --}}
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-5 lg:gap-16 mt-16">

            {{-- Left Column: Contact Info & Map (3/5) --}}
            <div class="lg:col-span-3 space-y-10">

                {{-- Contact Information Cards --}}
                <div class="space-y-6">
                    <div class="flex items-center space-x-3 mb-8">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <x-ui.text-gradient as="h2" variant="primary" size="xl" class="text-2xl">
                            Informasi Kontak
                        </x-ui.text-gradient>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-contact.info-card
                            icon="location"
                            title="Alamat Kantor"
                            content="Jl. M.T Haryono Komp. Perkantoran Pemda Kab. Katingan, Kasongan, Kalimantan Tengah, Indonesia 74411"
                            class="transform hover:scale-105 transition-all duration-300" />

                        <x-contact.info-card
                            icon="phone"
                            title="Telepon"
                            content="0821-5108-5359"
                            link="tel:+6282151085359"
                            class="transform hover:scale-105 transition-all duration-300" />

                        <x-contact.info-card
                            icon="email"
                            title="Email Resmi"
                            content="perkimtankabkatingan@gmail.com"
                            link="mailto:perkimtankabkatingan@gmail.com"
                            class="transform hover:scale-105 transition-all duration-300" />

                        <x-contact.info-card
                            icon="whatsapp"
                            title="WhatsApp"
                            content="0821-5108-5359"
                            link="https://wa.me/6282151085359"
                            class="transform hover:scale-105 transition-all duration-300" />

                        <x-contact.info-card
                            icon="clock"
                            title="Jam Kerja"
                            content="Senin - Kamis: 07:30 - 16:00 WIB, Jumat: 07:30 - 11:00 & 13:00 - 16:00 WIB"
                            class="transform hover:scale-105 transition-all duration-300" />

                        {{-- <x-contact.info-card
                            icon="fax"
                            title="Faksimile"
                            content="(0536) 3221-456"
                            class="transform hover:scale-105 transition-all duration-300" /> --}}
                    </div>
                </div>

                {{-- Map Section --}}
                <div class="space-y-6">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                </svg>
                            </div>
                        </div>
                        <x-ui.text-gradient as="h2" variant="primary" size="xl" class="text-2xl">
                            Lokasi & Petunjuk Arah
                        </x-ui.text-gradient>
                    </div>

                    <div class="relative group">
                        <div class="aspect-[4/3] w-full rounded-2xl overflow-hidden shadow-2xl border-4 border-white group-hover:shadow-3xl transition-shadow duration-500">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2723.6686343734063!2d113.42126988587353!3d-1.8744322996035985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dfce3000f4e3ad3%3A0xcb7f83fe7be095a!2sDisperkimtan%20katingan!5e0!3m2!1sid!2sid!4v1756870873153!5m2!1sid!2sid"
                                    width="100%"
                                    height="100%"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    class="w-full h-full">
                            </iframe>
                        </div>

                        {{-- Map overlay with location info --}}
                        {{-- <div class="absolute top-6 left-6 bg-white/95 backdrop-blur-sm px-4 py-3 rounded-xl shadow-lg border border-white/50">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                                <p class="text-sm font-semibold text-gray-900">📍 Dinas Perumahan, Kawasan Permukiman & Pertanahan</p>
                            </div>
                            <p class="text-xs text-gray-600 mt-1">Jl. Yos Sudarso No. 12, Palangka Raya</p>
                            <p class="text-xs text-gray-500">Klik untuk buka di Google Maps</p>
                        </div> --}}

                        {{-- Direction buttons --}}
                        <div class="absolute bottom-6 right-6 space-x-2">
                            <a href="https://maps.google.com/directions/"
                               target="_blank"
                               class="inline-flex items-center px-4 py-2 bg-white/95 backdrop-blur-sm text-sm font-medium text-gray-700 rounded-lg shadow-lg border border-white/50 hover:bg-indigo-50 hover:text-indigo-700 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 7l5 5-5 5"/>
                                </svg>
                                Petunjuk Arah
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Contact Form (2/5) --}}
            <div class="lg:col-span-2">
                <div class="sticky top-8">
                    <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-100 hover:shadow-3xl transition-shadow duration-500">

                        {{-- Form Header --}}
                        <div class="text-center mb-8">
                            <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                            </div>
                            <x-ui.text-gradient as="h3" variant="primary" size="xl" class="text-2xl mb-2">
                                Kirim Pesan
                            </x-ui.text-gradient>
                            <p class="text-gray-600">Isi formulir di bawah ini dan kami akan merespons secepatnya.</p>
                        </div>

                        {{-- Success Message --}}
                        @if (session('success'))
                            <x-ui.alert type="success" :message="session('success')" class="mb-6" />
                        @endif

                        {{-- Contact Form --}}
                        <form action="{{ route('kontak.store.public') }}" method="POST" class="space-y-6" x-data="contactForm()">
                            @csrf

                            <div class="space-y-6">
                                <x-ui.form-input
                                    name="nama_pengirim"
                                    label="Nama Lengkap"
                                    placeholder="Masukkan nama lengkap Anda"
                                    :required="true" />

                                <x-ui.form-input
                                    type="email"
                                    name="email_pengirim"
                                    label="Email"
                                    placeholder="contoh@email.com"
                                    :required="true" />

                                <x-ui.form-input
                                    type="tel"
                                    name="telepon"
                                    label="Telepon / WhatsApp"
                                    placeholder="08xxxxxxxxxx" />

                                <x-ui.form-select
                                    name="tipe_pesan"
                                    label="Tipe Pesan"
                                    :required="true">
                                    <option value="">Pilih tipe pesan</option>
                                    <option value="Permohonan" {{ old('tipe_pesan') == 'Permohonan' ? 'selected' : '' }}>📝 Permohonan</option>
                                    <option value="Pengaduan" {{ old('tipe_pesan') == 'Pengaduan' ? 'selected' : '' }}>⚠️ Pengaduan</option>
                                    <option value="Informasi" {{ old('tipe_pesan') == 'Informasi' ? 'selected' : '' }}>ℹ️ Informasi</option>
                                </x-ui.form-select>

                                <x-ui.form-input
                                    name="subjek"
                                    label="Subjek"
                                    placeholder="Subjek pesan Anda"
                                    :required="true" />

                                <x-ui.form-textarea
                                    name="isi_pesan"
                                    label="Isi Pesan"
                                    placeholder="Tulis pesan Anda di sini..."
                                    :rows="5"
                                    :required="true" />

                                {{-- CAPTCHA - Pilih salah satu --}}
                                {{-- Option 1: Google reCAPTCHA v2 (pastikan RECAPTCHA_SITE_KEY dan RECAPTCHA_SECRET_KEY sudah diset di .env) --}}
                                @if(config('services.recaptcha.site_key'))
                                    <x-ui.recaptcha />
                                @else
                                    {{-- Option 2: Simple Math CAPTCHA (fallback jika reCAPTCHA tidak dikonfigurasi) --}}
                                    <x-ui.math-captcha />
                                @endif
                            </div>

                            {{-- Submit Button --}}
                            <div class="pt-6 border-t border-gray-100">
                                <button type="submit"
                                        class="w-full btn-primary px-6 py-4 text-base font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 relative overflow-hidden group">
                                    <span class="relative z-10 flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2 group-hover:animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                        </svg>
                                        Kirim Pesan Sekarang
                                    </span>
                                    {{-- Animated background --}}
                                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-indigo-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                                </button>
                            </div>

                            {{-- Privacy Notice --}}
                            <div class="bg-gray-50 rounded-lg p-4 text-center">
                                <p class="text-xs text-gray-500">
                                    🔒 Data pribadi Anda akan kami jaga kerahasiaannya sesuai dengan kebijakan privasi yang berlaku.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function contactForm() {
    return {
        init() {
            // No interactions to prevent auto scroll
        }
    }
}

// Minimal JavaScript - NO auto scroll features
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (form) {
        // Simple submit handler - no validation styling to prevent scroll triggers
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let allValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    allValid = false;
                }
            });

            if (!allValid) {
                e.preventDefault();
                // Simple alert without DOM manipulation
                alert('❌ Mohon lengkapi semua field yang wajib diisi');
            }
        });
    }
});
</script>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

.animate-fade-in-up {
    animation: fade-in 0.6s ease-out;
}

.animation-delay-200 {
    animation-delay: 0.2s;
}

/* Enhanced shadows */
.shadow-3xl {
    box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
}
</style>
@endpush
