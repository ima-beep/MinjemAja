<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Test Guru
        User::create([
            'name' => 'Guru Buku',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);
    }
}

