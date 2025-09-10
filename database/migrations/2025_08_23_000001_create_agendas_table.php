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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('konten');

            // Event details
            $table->date('tanggal_agenda');
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('penyelenggara')->nullable();

            // Media & attachments
            $table->string('gambar')->nullable();
            $table->string('lampiran')->nullable();

            // Classification
            $table->enum('kategori', ['rapat', 'sosialisasi', 'workshop', 'acara_publik'])
                  ->default('rapat');
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi', 'mendesak'])
                  ->default('sedang');
            $table->enum('status', ['draft', 'published', 'selesai', 'dibatalkan'])
                  ->default('draft');

            // Flags
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_publik')->default(true);

            // Audit
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            // Indexes for performance
            $table->index(['status', 'tanggal_agenda']);
            $table->index(['kategori', 'tanggal_agenda']);
            $table->index(['is_featured', 'status']);
            $table->index(['is_publik', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
