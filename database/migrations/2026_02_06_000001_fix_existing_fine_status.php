<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Set fine_status to NULL for rows that were auto-created as 'pending_payment' without a request date
        DB::table('loans')
            ->where('fine_status', 'pending_payment')
            ->whereNull('fine_payment_request_date')
            ->update(['fine_status' => null]);
    }

    public function down(): void
    {
        // Revert: set those rows back to 'pending_payment' (best effort)
        DB::table('loans')
            ->whereNull('fine_payment_request_date')
            ->whereNull('fine_status')
            ->update(['fine_status' => 'pending_payment']);
    }
};
