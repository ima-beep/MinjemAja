<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed user test (guru dan siswa)
        $this->call(UserSeeder::class);

        // Seed penerbit Indonesia
        $this->call(PublisherSeeder::class);

        // Seed pengarang Indonesia
        $this->call(AuthorSeeder::class);

        // Seed kategori buku
        $this->call(CategorySeeder::class);

        // Seed buku contoh
        $this->call(BookSeeder::class);
    }
}
