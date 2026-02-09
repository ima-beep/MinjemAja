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
        Schema::table('loans', function (Blueprint $table) {
            $table->timestamp('fine_payment_request_date')->nullable()->after('status');
            $table->enum('fine_status', ['pending_payment', 'approved_payment', 'rejected_payment'])->nullable()->after('fine_payment_request_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn(['fine_payment_request_date', 'fine_status']);
        });
    }
};
