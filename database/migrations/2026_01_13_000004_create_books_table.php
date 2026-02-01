<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->date('publication_date')->nullable();
            $table->text('description')->nullable();

            // FILE
            $table->string('cover_image')->nullable();
            $table->string('file_path')->nullable(); // ✅ PDF

            // TIPE & STOK
            $table->enum('book_type', ['soft', 'hard'])->default('soft');
            $table->integer('stok')->default(0); // ✅ WAJIB

            // RELASI
            $table->foreignId('publisher_id')
                ->nullable()
                ->constrained('publishers')
                ->nullOnDelete();

            $table->foreignId('author_id')
                ->nullable()
                ->constrained('authors')
                ->nullOnDelete();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
