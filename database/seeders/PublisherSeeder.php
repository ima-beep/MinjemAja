<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the publishers table dengan data penerbit Indonesia
     */
    public function run(): void
    {
        $publishers = [
            [
                'name' => 'Gramedia Pustaka Utama',
                'address' => 'Jl. Palmerah Barat 33-37, Jakarta 10270',
                'phone' => '(021) 535-5082',
                'email' => 'info@gramedia.com',
                'description' => 'Penerbit terbesar di Indonesia dengan berbagai koleksi buku berkualitas',
            ],
            [
                'name' => 'PT Mizan Pustaka',
                'address' => 'Jl. Ciputat Raya No. 125, Tangerang 15412',
                'phone' => '(021) 746-9995',
                'email' => 'info@mizan.com',
                'description' => 'Penerbit yang fokus pada buku-buku berkualitas tinggi dan edukasi',
            ],
            [
                'name' => 'Erlangga',
                'address' => 'Jl. H. Samali No. 47, Jakarta 12220',
                'phone' => '(021) 640-6666',
                'email' => 'info@erlangga.co.id',
                'description' => 'Penerbit pendidikan dan umum terkemuka di Indonesia',
            ],
            [
                'name' => 'Bentang Pustaka',
                'address' => 'Jl. Cikini Raya No. 73, Jakarta 10330',
                'phone' => '(021) 315-0333',
                'email' => 'info@bentangpustaka.com',
                'description' => 'Penerbit independen yang menerbitkan karya-karya berkualitas',
            ],
            [
                'name' => 'Penerbit Andi',
                'address' => 'Jl. Beo No. 38-40, Yogyakarta 55281',
                'phone' => '(0274) 561-881',
                'email' => 'info@andipublisher.com',
                'description' => 'Penerbit buku komputer dan teknologi terlengkap di Indonesia',
            ],
            [
                'name' => 'PT Intan Sejati',
                'address' => 'Jl. Merdeka No. 123, Bandung 40173',
                'phone' => '(022) 420-4567',
                'email' => 'info@intansejati.com',
                'description' => 'Penerbit buku pelajaran dan referensi terpercaya',
            ],
            [
                'name' => 'Grasindo',
                'address' => 'Jl. Dewi Sartika No. 136, Jakarta 12630',
                'phone' => '(021) 798-3888',
                'email' => 'info@grasindo.co.id',
                'description' => 'Penerbit buku olahraga, hobi, dan gaya hidup',
            ],
            [
                'name' => 'Penerbit Kompas',
                'address' => 'Jl. Jenderal Sudirman 66, Jakarta 12190',
                'phone' => '(021) 526-2828',
                'email' => 'info@kompas.com',
                'description' => 'Penerbit media dan buku dari Kompas Gramedia',
            ],
        ];

        foreach ($publishers as $publisher) {
            Publisher::create($publisher);
        }
    }
}
