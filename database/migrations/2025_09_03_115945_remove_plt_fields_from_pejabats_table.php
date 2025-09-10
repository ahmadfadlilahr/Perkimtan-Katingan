<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pejabats', function (Blueprint $table) {
            // Hapus kolom-kolom PLT yang tidak diperlukan
            $table->dropColumn(['is_plt', 'tanggal_plt', 'plt_hingga']);

            // Juga hapus kolom status dan keterangan_status jika tidak diperlukan
            // Uncomment baris di bawah jika ingin menghapus kolom status juga
            // $table->dropColumn(['status', 'keterangan_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pejabats', function (Blueprint $table) {
            // Kembalikan kolom PLT jika migration di-rollback
            $table->boolean('is_plt')->default(false);
            $table->date('tanggal_plt')->nullable();
            $table->date('plt_hingga')->nullable();

            // Kembalikan kolom status jika diperlukan
            // $table->enum('status', ['aktif', 'nonaktif', 'pensiun'])->default('aktif');
            // $table->text('keterangan_status')->nullable();
        });
    }
};
