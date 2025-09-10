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
        Schema::create('visi_misis', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('visi, misi, nilai, tujuan');
            $table->string('title');
            $table->text('content');
            $table->text('description')->nullable()->comment('Deskripsi tambahan untuk nilai dan tujuan');
            $table->string('icon')->nullable()->comment('Icon class untuk nilai-nilai');
            $table->string('color_class')->nullable()->comment('CSS class untuk warna');
            $table->integer('order_position')->default(0)->comment('Urutan tampil');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['type', 'is_active', 'order_position']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visi_misis');
    }
};
