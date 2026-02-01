<?php

namespace Database\Seeders;

use App\Models\Publisher;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookDataSeeder extends Seeder
{
    public function run(): void
    {
        // Publishers
        Publisher::create(['name' => 'PT Gramedia', 'description' => 'Penerbit terkemuka Indonesia']);
        Publisher::create(['name' => 'Penerbit Erlangga', 'description' => 'Penerbit buku pelajaran dan umum']);
        Publisher::create(['name' => 'Gajah Mada University Press', 'description' => 'Penerbit akademik']);

        // Authors
        Author::create(['name' => 'Pramoedya Ananta Toer', 'biography' => 'Penulis Indonesia terkenal']);
        Author::create(['name' => 'Andrea Hirata', 'biography' => 'Penulis laskar pelangi']);
        Author::create(['name' => 'Sapardi Djoko Damono', 'biography' => 'Penulis puisi']);
        Author::create(['name' => 'Tere Liye', 'biography' => 'Penulis fiksi populer']);

        // Categories
        Category::create(['name' => 'Fiksi', 'description' => 'Buku cerita dan novel']);
        Category::create(['name' => 'Non-Fiksi', 'description' => 'Buku pengetahuan']);
        Category::create(['name' => 'Puisi', 'description' => 'Kumpulan puisi']);
        Category::create(['name' => 'Pelajaran', 'description' => 'Buku pelajaran sekolah']);
        Category::create(['name' => 'Referensi', 'description' => 'Buku referensi dan panduan']);
    }
}
