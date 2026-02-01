<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate all tables
        User::truncate();
        Author::truncate();
        Publisher::truncate();
        Category::truncate();
        Book::truncate();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create users
        User::create([
            'name' => 'Guru Test',
            'email' => 'guru@test.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        User::create([
            'name' => 'Siswa Test',
            'email' => 'siswa@test.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        // Create authors
        $author1 = Author::create([
            'name' => 'Eka Prasetya Sugandi',
            'birth_date' => '1990-05-15',
            'nationality' => 'Indonesia',
        ]);

        $author2 = Author::create([
            'name' => 'Dwi Sulistyo Wibowo',
            'birth_date' => '1988-03-20',
            'nationality' => 'Indonesia',
        ]);

        // Create publishers
        $publisher1 = Publisher::create([
            'name' => 'Penerbit Erlangga',
            'address' => 'Jakarta',
            'phone' => '021-123456',
            'email' => 'contact@erlangga.com',
        ]);

        $publisher2 = Publisher::create([
            'name' => 'Penerbit Gramedia',
            'address' => 'Jakarta',
            'phone' => '021-654321',
            'email' => 'contact@gramedia.com',
        ]);

        // Create categories
        Category::create(['name' => 'Fiksi']);
        Category::create(['name' => 'Non-Fiksi']);
        Category::create(['name' => 'Teknologi']);

        $category3 = Category::where('name', 'Teknologi')->first();

        // Create books
        Book::create([
            'name' => 'Belajar Pemrograman PHP untuk Pemula',
            'author_id' => $author1->id,
            'publisher_id' => $publisher1->id,
            'category_id' => $category3->id,
            'publication_date' => '2022-01-15',
            'stok' => 10,
            'description' => 'Buku panduan lengkap belajar PHP dari dasar hingga mahir. Cocok untuk pemula yang ingin memulai pemrograman web.',
        ]);

        Book::create([
            'name' => 'Laravel untuk Developer Web Modern',
            'author_id' => $author2->id,
            'publisher_id' => $publisher2->id,
            'category_id' => $category3->id,
            'publication_date' => '2023-06-10',
            'stok' => 8,
            'description' => 'Panduan komprehensif menggunakan framework Laravel untuk membangun aplikasi web yang scalable dan maintainable.',
        ]);

        Book::create([
            'name' => 'Kisah-Kisah Inspiratif dari Para Entrepreneur',
            'author_id' => $author1->id,
            'publisher_id' => $publisher1->id,
            'category_id' => 1,
            'publication_date' => '2021-09-20',
            'stok' => 5,
            'description' => 'Kumpulan cerita inspiratif dari entrepreneur sukses yang berbagi pengalaman dan pembelajaran mereka.',
        ]);

        Book::create([
            'name' => 'Database Design Best Practices',
            'author_id' => $author2->id,
            'publisher_id' => $publisher2->id,
            'category_id' => 2,
            'publication_date' => '2023-02-14',
            'stok' => 12,
            'description' => 'Panduan mendalam tentang desain database yang optimal untuk performa dan skalabilitas maksimal.',
        ]);
    }
}
