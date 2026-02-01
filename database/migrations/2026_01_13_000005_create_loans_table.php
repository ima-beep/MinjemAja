<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();

            // RELASI BUKU
            $table->foreignId('book_id')
                ->constrained()
                ->onDelete('cascade');

            // IDENTITAS GUEST
            $table->string('guest_name');
            $table->string('guest_nisn');
            $table->string('guest_class');
            $table->string('guest_email');
            $table->string('guest_phone');

            // DATA PINJAMAN
            $table->date('loan_date');
            $table->date('return_date');
            $table->date('actual_return_date')->nullable();

            $table->enum('status', ['active', 'returned'])->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
