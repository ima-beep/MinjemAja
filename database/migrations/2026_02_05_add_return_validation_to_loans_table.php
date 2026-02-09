<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            // Tambah kolom untuk return request date
            $table->dateTime('return_request_date')->nullable()->after('actual_return_date');
        });

        // Update status enum dengan proper MySQL syntax
        DB::statement("ALTER TABLE loans CHANGE COLUMN status status ENUM('active', 'pending_return', 'returned') DEFAULT 'active'");
    }

    public function down(): void
    {
        // Revert enum ke nilai sebelumnya
        DB::statement("ALTER TABLE loans CHANGE COLUMN status status ENUM('active', 'returned') DEFAULT 'active'");

        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn('return_request_date');
        });
    }
};
