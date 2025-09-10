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
    Schema::create('slides', function (Blueprint $table) {
        $table->id();
        $table->string('gambar');
        $table->string('judul')->nullable();
        $table->text('subjudul')->nullable();
        $table->string('tombol_teks')->nullable();
        $table->string('tombol_url')->nullable();
        $table->integer('urutan')->default(0);
        $table->enum('status', ['published', 'draft'])->default('draft');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slides');
    }
};
