<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate; // Pastikan 'use' statement ini ada
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Tambahkan kode ini di dalam method boot()
        // Secara implisit memberikan semua izin kepada Super Admin
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });
    }
}
