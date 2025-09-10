<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user if not exists
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@dinasperkim.go.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
                'role' => 'admin',
                'status' => 'active',
            ]
        );

        // Update existing user if needed
        if (!$adminUser->role) {
            $adminUser->update([
                'role' => 'admin',
                'status' => 'active'
            ]);
        }

        // Assign super-admin role if exists
        if (Role::where('name', 'super-admin')->exists()) {
            $adminUser->assignRole('super-admin');
        }

        $this->command->info('✅ Admin user created/updated:');
        $this->command->info('- Email: admin@dinasperkim.go.id');
        $this->command->info('- Password: admin123');
        $this->command->info('- Role: super-admin');
    }
}
