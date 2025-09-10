<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat Permissions menggunakan firstOrCreate
        Permission::firstOrCreate(['name' => 'kelola berita']);
        Permission::firstOrCreate(['name' => 'kelola agenda']);
        Permission::firstOrCreate(['name' => 'kelola halaman']);
        Permission::firstOrCreate(['name' => 'kelola pejabat']);
        Permission::firstOrCreate(['name' => 'kelola unduhan']);
        Permission::firstOrCreate(['name' => 'kelola galeri']);
        Permission::firstOrCreate(['name' => 'kelola pesan']);
        Permission::firstOrCreate(['name' => 'kelola pengguna']);
        Permission::firstOrCreate(['name' => 'kelola slider']);

        // Buat Roles menggunakan firstOrCreate dan berikan izin
        $rolePenulis = Role::firstOrCreate(['name' => 'penulis']);
        $rolePenulis->syncPermissions(['kelola berita']);

        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleAdmin->syncPermissions([
            'kelola berita',
            'kelola agenda',
            'kelola halaman',
            'kelola pejabat',
            'kelola unduhan',
            'kelola galeri',
            'kelola pesan',
            'kelola slider',
        ]);

        $roleSuperAdmin = Role::firstOrCreate(['name' => 'super-admin']);
    }
}
