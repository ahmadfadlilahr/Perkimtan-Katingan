<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $this->command->error('No users found. Please run UserSeeder first.');
            return;
        }

        $agendas = [
            [
                'judul' => 'Rapat Koordinasi Bulanan Dinas Perkim',
                'slug' => 'rapat-koordinasi-bulanan-dinas-perkim',
                'konten' => '<p>Rapat koordinasi rutin bulanan membahas progress pembangunan infrastruktur dan permukiman di wilayah administrasi. Agenda meliputi evaluasi proyek berjalan, perencanaan proyek baru, dan koordinasi dengan stakeholder terkait.</p><h3>Agenda Rapat:</h3><ul><li>Pembukaan dan presensi peserta</li><li>Laporan progress proyek infrastruktur bulan ini</li><li>Evaluasi anggaran dan realisasi</li><li>Perencanaan proyek periode mendatang</li><li>Koordinasi dengan instansi terkait</li><li>Penutup dan tindak lanjut</li></ul><h3>Peserta:</h3><p>Seluruh kepala bidang, kepala seksi, dan staf terkait Dinas Perkim.</p>',
                'tanggal_agenda' => date('Y-m-d', strtotime('+7 days')),
                'waktu_mulai' => '09:00:00',
                'waktu_selesai' => '12:00:00',
                'lokasi' => 'Ruang Rapat Lantai 2 Dinas Perkim',
                'kategori' => 'rapat',
                'status' => 'published',
                'prioritas' => 'tinggi',
                'is_publik' => false,
                'is_featured' => true,
                'created_by' => $user->id,
            ],
            [
                'judul' => 'Sosialisasi Program Bantuan Rumah Layak Huni',
                'slug' => 'sosialisasi-program-bantuan-rumah-layak-huni',
                'konten' => '<p>Kegiatan sosialisasi program bantuan rumah layak huni kepada masyarakat berpenghasilan rendah. Program ini bertujuan untuk meningkatkan kualitas hunian masyarakat melalui bantuan renovasi dan pembangunan rumah baru.</p><h3>Tujuan Program:</h3><p>Meningkatkan kualitas hunian masyarakat berpenghasilan rendah melalui program bantuan stimulus.</p><h3>Kriteria Penerima:</h3><ul><li>Keluarga berpenghasilan rendah</li><li>Kondisi rumah tidak layak huni</li><li>Memiliki surat keterangan tidak mampu</li><li>Terdaftar sebagai warga setempat minimal 2 tahun</li></ul><h3>Bantuan yang Diberikan:</h3><ul><li>Material bangunan sesuai kebutuhan</li><li>Tenaga kerja ahli</li><li>Pendampingan teknis</li></ul>',
                'tanggal_agenda' => date('Y-m-d', strtotime('+14 days')),
                'waktu_mulai' => '08:00:00',
                'waktu_selesai' => '16:00:00',
                'lokasi' => 'Balai Desa Sukamaju',
                'kategori' => 'sosialisasi',
                'status' => 'published',
                'prioritas' => 'sedang',
                'is_publik' => true,
                'is_featured' => true,
                'created_by' => $user->id,
            ],
            [
                'judul' => 'Pelatihan Teknis Pengawasan Konstruksi',
                'slug' => 'pelatihan-teknis-pengawasan-konstruksi',
                'konten' => '<p>Pelatihan teknis untuk meningkatkan kapasitas aparatur dalam melakukan pengawasan konstruksi bangunan. Materi meliputi standar konstruksi, metode pengawasan, dan penggunaan teknologi dalam monitoring proyek.</p><h3>Materi Pelatihan:</h3><ul><li>Standar Nasional Indonesia (SNI) Konstruksi</li><li>Metode pengawasan lapangan</li><li>Teknologi monitoring dan inspeksi</li><li>Quality assurance dan quality control</li><li>Dokumentasi dan pelaporan</li><li>Studi kasus dan best practices</li></ul><h3>Narasumber:</h3><p>Ahli konstruksi bersertifikat dan praktisi berpengalaman dari berbagai instansi.</p>',
                'tanggal_agenda' => date('Y-m-d', strtotime('+21 days')),
                'waktu_mulai' => '08:30:00',
                'waktu_selesai' => '17:00:00',
                'lokasi' => 'Hotel Grand Dafam Semarang',
                'kategori' => 'workshop',
                'status' => 'published',
                'prioritas' => 'sedang',
                'is_publik' => false,
                'is_featured' => false,
                'created_by' => $user->id,
            ],
            [
                'judul' => 'Monitoring Proyek Jalan Tol Akses Pelabuhan',
                'slug' => 'monitoring-proyek-jalan-tol-akses-pelabuhan',
                'konten' => '<p>Kegiatan monitoring dan evaluasi progress pembangunan jalan tol akses pelabuhan. Meliputi review kemajuan fisik, kualitas pekerjaan, dan kesesuaian dengan jadwal yang telah ditetapkan.</p><h3>Scope Monitoring:</h3><ul><li>Review progress fisik pembangunan</li><li>Evaluasi kualitas material dan pekerjaan</li><li>Verifikasi kesesuaian dengan spesifikasi teknis</li><li>Assessment timeline dan milestone</li><li>Identifikasi kendala dan solusi</li></ul><h3>Tim Monitoring:</h3><p>Kepala Bidang Jalan dan Jembatan beserta staf teknis terkait.</p>',
                'tanggal_agenda' => date('Y-m-d', strtotime('+5 days')),
                'waktu_mulai' => '07:00:00',
                'waktu_selesai' => '15:00:00',
                'lokasi' => 'Lokasi Proyek Jalan Tol Km 15',
                'kategori' => 'rapat',
                'status' => 'published',
                'prioritas' => 'tinggi',
                'is_publik' => false,
                'is_featured' => false,
                'created_by' => $user->id,
            ],
            [
                'judul' => 'Workshop Smart City dan Infrastruktur Digital',
                'slug' => 'workshop-smart-city-dan-infrastruktur-digital',
                'konten' => '<p>Workshop tentang konsep smart city dan implementasi infrastruktur digital dalam pembangunan perkotaan. Membahas teknologi IoT, sistem monitoring digital, dan integrasi data untuk perencanaan kota cerdas.</p><h3>Topik Pembahasan:</h3><ul><li>Konsep dan filosofi smart city</li><li>Infrastruktur digital dan IoT</li><li>Big data untuk urban planning</li><li>Sistem monitoring real-time</li><li>Integrasi platform digital</li><li>Implementasi dan roadmap</li></ul><h3>Target Output:</h3><p>Roadmap implementasi smart city untuk wilayah administrasi dengan prioritas sektor infrastruktur.</p>',
                'tanggal_agenda' => date('Y-m-d', strtotime('+28 days')),
                'waktu_mulai' => '09:00:00',
                'waktu_selesai' => '16:30:00',
                'lokasi' => 'Auditorium Universitas Diponegoro',
                'kategori' => 'workshop',
                'status' => 'published',
                'prioritas' => 'sedang',
                'is_publik' => true,
                'is_featured' => false,
                'created_by' => $user->id,
            ],
            [
                'judul' => 'Evaluasi Program Sanitasi Perkotaan',
                'slug' => 'evaluasi-program-sanitasi-perkotaan',
                'konten' => '<p>Kegiatan evaluasi terhadap program sanitasi perkotaan yang telah berjalan selama setahun terakhir. Review pencapaian target, kendala yang dihadapi, dan strategi perbaikan untuk periode mendatang.</p><h3>Aspek Evaluasi:</h3><ul><li>Pencapaian target pembangunan IPAL</li><li>Efektivitas program sanitasi masyarakat</li><li>Kualitas air limbah domestik</li><li>Partisipasi masyarakat dalam program</li><li>Anggaran dan realisasi</li></ul><h3>Output yang Diharapkan:</h3><p>Laporan evaluasi komprehensif dan rekomendasi strategi untuk tahun mendatang.</p>',
                'tanggal_agenda' => date('Y-m-d', strtotime('+35 days')),
                'waktu_mulai' => '10:00:00',
                'waktu_selesai' => '15:00:00',
                'lokasi' => 'Ruang Meeting Lt. 3 Dinas Perkim',
                'kategori' => 'rapat',
                'status' => 'published',
                'prioritas' => 'rendah',
                'is_publik' => false,
                'is_featured' => false,
                'created_by' => $user->id,
            ],
        ];

        foreach ($agendas as $agendaData) {
            Agenda::create($agendaData);
        }

        $this->command->info('Agenda seeder completed successfully!');
    }
}
