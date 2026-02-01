<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the categories table dengan berbagai kategori buku
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fiksi',
                'description' => 'Novel, cerita pendek, dan karya fiksi lainnya',
            ],
            [
                'name' => 'Non-Fiksi',
                'description' => 'Buku faktual, biografi, dan pengetahuan umum',
            ],
            [
                'name' => 'Teknologi',
                'description' => 'Buku tentang komputer, programming, dan teknologi modern',
            ],
            [
                'name' => 'Pendidikan',
                'description' => 'Buku pelajaran, referensi akademik, dan panduan belajar',
            ],
            [
                'name' => 'Bisnis & Ekonomi',
                'description' => 'Buku tentang bisnis, keuangan, dan strategi entrepreneurship',
            ],
            [
                'name' => 'Seni & Budaya',
                'description' => 'Buku tentang seni, desain, musik, dan warisan budaya',
            ],
            [
                'name' => 'Sejarah',
                'description' => 'Buku sejarah nasional dan internasional',
            ],
            [
                'name' => 'Psikologi & Self-Help',
                'description' => 'Buku tentang psikologi, pengembangan diri, dan motivasi',
            ],
            [
                'name' => 'Kesehatan & Wellness',
                'description' => 'Buku tentang kesehatan, olahraga, dan gaya hidup sehat',
            ],
            [
                'name' => 'Anak-anak',
                'description' => 'Buku cerita, dongeng, dan buku edukatif untuk anak-anak',
            ],
            [
                'name' => 'Puisi & Sastra',
                'description' => 'Kumpulan puisi, drama, dan karya sastra klasik',
            ],
            [
                'name' => 'Petualangan & Misteri',
                'description' => 'Buku petualangan, detektif, dan misteri yang seru',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
