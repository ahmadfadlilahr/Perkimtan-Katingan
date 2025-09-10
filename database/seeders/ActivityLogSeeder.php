<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ActivityLog;
use App\Models\User;

class ActivityLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $this->command->warn('No users found. Please run UserSeeder first.');
            return;
        }

        // Sample activity logs for demonstration
        $activities = [
            [
                'user_id' => $user->id,
                'action' => 'login',
                'description' => 'Login ke sistem',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'created_at' => now()->subMinutes(5),
            ],
            [
                'user_id' => $user->id,
                'action' => 'create',
                'model' => 'Berita',
                'model_id' => 1,
                'model_title' => 'Pengumuman Terbaru dari Dinas Perkim',
                'description' => 'Membuat berita: Pengumuman Terbaru dari Dinas Perkim',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'created_at' => now()->subMinutes(10),
            ],
            [
                'user_id' => $user->id,
                'action' => 'update',
                'model' => 'Halaman',
                'model_id' => 1,
                'model_title' => 'Profil Dinas',
                'description' => 'Memperbarui halaman: Profil Dinas',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'created_at' => now()->subMinutes(15),
            ],
            [
                'user_id' => $user->id,
                'action' => 'create',
                'model' => 'Galeri',
                'model_id' => 1,
                'model_title' => 'Kegiatan Pembangunan Jalan',
                'description' => 'Membuat foto galeri: Kegiatan Pembangunan Jalan',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'created_at' => now()->subMinutes(20),
            ],
            [
                'user_id' => $user->id,
                'action' => 'view',
                'model' => 'Pesan',
                'description' => 'Melihat pesan dari masyarakat',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'created_at' => now()->subMinutes(25),
            ],
            [
                'user_id' => $user->id,
                'action' => 'update',
                'model' => 'Pejabat',
                'model_id' => 1,
                'model_title' => 'Kepala Dinas Perkim',
                'description' => 'Memperbarui data pejabat: Kepala Dinas Perkim',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'created_at' => now()->subMinutes(30),
            ],
        ];

        foreach ($activities as $activity) {
            ActivityLog::create($activity);
        }

        $this->command->info('Activity logs seeded successfully!');
    }
}
