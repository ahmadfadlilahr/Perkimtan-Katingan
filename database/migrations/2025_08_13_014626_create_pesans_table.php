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
    Schema::create('pesans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_pengirim');
        $table->string('email_pengirim');
        $table->string('telepon')->nullable();
        $table->enum('tipe_pesan', ['Pengaduan', 'Permohonan', 'Informasi'])->nullable();
        $table->string('subjek');
        $table->text('isi_pesan');
        $table->string('lampiran')->nullable();
        $table->enum('status', ['Belum Dibaca', 'Sedang Proses', 'Sudah Dibaca'])->default('Belum Dibaca');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesans');
    }
};
