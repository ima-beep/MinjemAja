<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            // Change date columns to datetime for accurate minute-based calculations
            $table->dateTime('loan_date')->change();
            $table->dateTime('return_date')->change();
            $table->dateTime('actual_return_date')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            // Revert to date columns
            $table->date('loan_date')->change();
            $table->date('return_date')->change();
            $table->date('actual_return_date')->nullable()->change();
        });
    }
};
