<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Check and add missing columns
            if (!Schema::hasColumn('reviews', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('reviews', 'book_id')) {
                $table->unsignedBigInteger('book_id')->after('user_id');
                $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            }
            if (!Schema::hasColumn('reviews', 'rating')) {
                $table->tinyInteger('rating')->default(5)->after('book_id');
            }
            if (!Schema::hasColumn('reviews', 'review')) {
                $table->text('review')->nullable()->after('rating');
            }
            if (!Schema::hasColumn('reviews', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            //
        });
    }
};
