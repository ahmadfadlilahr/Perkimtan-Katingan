<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beritas = [
            [
                'judul' => 'Pembangunan Jembatan Baru di Kota Tanjung',
                'penulis' => 'Admin Dinas Perkim',
                'isi' => 'Dinas Pekerjaan Umum dan Perumahan Rakyat melaksanakan pembangunan jembatan baru di Kota Tanjung sebagai upaya meningkatkan konektivitas antar wilayah. Pembangunan ini diharapkan dapat memperlancar arus lalu lintas dan mendukung perekonomian masyarakat setempat.',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'judul' => 'Program Peningkatan Infrastruktur Jalan Desa',
                'penulis' => 'Tim Publikasi',
                'isi' => 'Dalam rangka mendukung konektivitas desa, Dinas Perkim meluncurkan program peningkatan infrastruktur jalan desa yang akan menjangkau 50 desa di seluruh kabupaten. Program ini mencakup perbaikan jalan existing dan pembangunan jalan baru.',
                'status' => 'published',
                'published_at' => now()->subDays(1),
            ],
            [
                'judul' => 'Rapat Koordinasi Perencanaan Pembangunan 2025',
                'penulis' => 'Sekretariat Dinas',
                'isi' => 'Dinas Perkim mengadakan rapat koordinasi untuk merencanakan program pembangunan tahun 2025. Rapat ini melibatkan seluruh stakeholder terkait untuk memastikan program berjalan sesuai target dan memberikan manfaat optimal bagi masyarakat.',
                'status' => 'draft',
                'published_at' => null,
            ],
            [
                'judul' => 'Sosialisasi Program Perumahan Rakyat',
                'penulis' => 'Bidang Perumahan',
                'isi' => 'Dinas melakukan sosialisasi program perumahan rakyat kepada masyarakat berpenghasilan rendah. Program ini bertujuan membantu masyarakat mendapatkan akses perumahan yang layak dan terjangkau melalui berbagai skema pembiayaan yang tersedia.',
                'status' => 'published',
                'published_at' => now()->subDays(3),
            ],
        ];

        foreach ($beritas as $berita) {
            Berita::create([
                'judul' => $berita['judul'],
                'slug' => Str::slug($berita['judul']),
                'penulis' => $berita['penulis'],
                'isi' => $berita['isi'],
                'status' => $berita['status'],
                'published_at' => $berita['published_at'],
                'gambar' => null, // Untuk testing tanpa gambar dulu
            ]);
        }
    }
}
