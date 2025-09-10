<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Delete all records with type 'nilai' or 'tujuan'
        DB::table('visi_misis')
            ->whereIn('type', ['nilai', 'tujuan'])
            ->delete();

        // Clean up any potential orphaned records
        DB::statement("DELETE FROM visi_misis WHERE type NOT IN ('visi', 'misi')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration cannot be reversed as we're deleting data
        // If you need to restore, you would need to re-insert the data manually
    }
};
