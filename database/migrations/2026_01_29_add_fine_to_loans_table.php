<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            if (!Schema::hasColumn('loans', 'fine_amount_paid')) {
                $table->decimal('fine_amount_paid', 10, 2)->default(0)->after('status');
            }
            if (!Schema::hasColumn('loans', 'fine_payment_date')) {
                $table->date('fine_payment_date')->nullable()->after('fine_amount_paid');
            }
            if (!Schema::hasColumn('loans', 'fine_notes')) {
                $table->text('fine_notes')->nullable()->after('fine_payment_date');
            }
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn(['fine_amount_paid', 'fine_payment_date', 'fine_notes']);
        });
    }
};
