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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('action'); // create, update, delete, login, logout
            $table->string('model')->nullable(); // Model name (Berita, Halaman, etc.)
            $table->unsignedBigInteger('model_id')->nullable(); // ID of the affected model
            $table->string('model_title')->nullable(); // Title or name of the affected model
            $table->json('old_values')->nullable(); // Previous values for updates
            $table->json('new_values')->nullable(); // New values for updates
            $table->text('description')->nullable(); // Human readable description
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'created_at']);
            $table->index(['model', 'model_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
