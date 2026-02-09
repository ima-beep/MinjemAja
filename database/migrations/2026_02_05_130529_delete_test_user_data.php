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
        // Delete loans with Test User as guest
        DB::table('loans')->where('guest_name', 'Test User')->delete();
        
        // Delete test user accounts
        DB::table('users')->where('name', 'Test User')->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No reverse needed for cleanup migration
    }
};
