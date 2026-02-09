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
        // First change the enum column to accept both 'teacher' and 'admin'
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['student', 'teacher', 'admin'])->default('student')->change();
        });
        
        // Then update all existing 'teacher' values to 'admin'
        DB::table('users')->where('role', 'teacher')->update(['role' => 'admin']);
        
        // Finally change the enum column to only accept 'student' and 'admin'
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['student', 'admin'])->default('student')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add 'teacher' back to enum
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['student', 'admin', 'teacher'])->default('student')->change();
        });
        
        // Revert: change 'admin' back to 'teacher'
        DB::table('users')->where('role', 'admin')->update(['role' => 'teacher']);
        
        // Remove 'admin' from enum
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['student', 'teacher'])->default('student')->change();
        });
    }
};
