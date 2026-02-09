<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Modify the fine_status column to allow NULL and default to NULL
        // Use raw statement to alter enum to nullable with default NULL
        DB::statement("ALTER TABLE loans MODIFY COLUMN fine_status ENUM('pending_payment','approved_payment','rejected_payment') NULL DEFAULT NULL AFTER status");
    }

    public function down(): void
    {
        // Revert to previous behavior (default pending_payment)
        DB::statement("ALTER TABLE loans MODIFY COLUMN fine_status ENUM('pending_payment','approved_payment','rejected_payment') NOT NULL DEFAULT 'pending_payment' AFTER status");
    }
};
