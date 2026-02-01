<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Seed the books table dengan data buku contoh
     */
    public function run(): void
    {
        $books = [
            [
                'name' => 'Tetralogi Pulau Buru',
                'author_id' => 1, // Pramoedya Ananta Toer
                'publisher_id' => 1, // Gramedia Pustaka Utama
                'category_id' => 1, // Fiksi
                'publication_date' => '1980-01-01',
                'description' => 'Karya monumental yang menceritakan perjuangan dan kehidupan rakyat Indonesia. Tetralogi ini terdiri dari empat novel yang menggunakan perspektif realistis dalam menyajikan sejarah.',
                'book_type' => 'soft',
                'stok' => 15,
            ],
            [
                'name' => 'Laskar Pelangi',
                'author_id' => 10, // Andrea Hirata
                'publisher_id' => 2, // PT Mizan Pustaka
                'category_id' => 1, // Fiksi
                'publication_date' => '2005-06-15',
                'description' => 'Novel tentang anak-anak miskin di sebuah pulau yang berjuang mendapatkan pendidikan. Cerita inspiratif yang telah diterjemahkan ke berbagai bahasa dunia.',
                'book_type' => 'soft',
                'stok' => 20,
            ],
            [
                'name' => 'Harimau! Harimau!',
                'author_id' => 7, // Mochtar Lubis
                'publisher_id' => 3, // Erlangga
                'category_id' => 1, // Fiksi
                'publication_date' => '1975-05-01',
                'description' => 'Novel klasik yang menceritakan kehidupan seorang harimau di hutan Sumatra. Karya yang penuh dengan deskripsi alam dan refleksi filosofis.',
                'book_type' => 'soft',
                'stok' => 12,
            ],
            [
                'name' => 'Surat-Surat Kepada Seorang Sahabat Muda',
                'author_id' => 5, // Tanah Air Beta
                'publisher_id' => 4, // Bentang Pustaka
                'category_id' => 2, // Non-Fiksi
                'publication_date' => '1998-08-20',
                'description' => 'Kumpulan surat-surat pribadi yang berisi pemikiran mendalam tentang kehidupan, cinta, dan perjuangan untuk menjadi manusia sejati.',
                'book_type' => 'soft',
                'stok' => 18,
            ],
            [
                'name' => 'Filosofi Keempat Soekarno',
                'author_id' => 9, // Emha Ainun Nadjib
                'publisher_id' => 1, // Gramedia Pustaka Utama
                'category_id' => 11, // Puisi & Sastra
                'publication_date' => '2012-03-10',
                'description' => 'Esai filosofis yang menggali pemikiran dan filosofi hidup Soekarno dengan pendekatan yang kritis dan humanis.',
                'book_type' => 'hard',
                'stok' => 10,
            ],
            [
                'name' => 'Sejarah Indonesia Modern',
                'author_id' => 2, // Sutan Sjahrir
                'publisher_id' => 8, // Penerbit Kompas
                'category_id' => 7, // Sejarah
                'publication_date' => '2001-06-01',
                'description' => 'Buku sejarah komprehensif yang menceritakan perjalanan Indonesia dari masa penjajahan hingga memasuki era modern dengan analisis mendalam.',
                'book_type' => 'hard',
                'stok' => 25,
            ],
            [
                'name' => 'Kumpulan Puisi Aku Ini Binatang Jalang',
                'author_id' => 3, // Chairil Anwar
                'publisher_id' => 2, // PT Mizan Pustaka
                'category_id' => 11, // Puisi & Sastra
                'publication_date' => '1946-06-01',
                'description' => 'Antologi puisi legendaris yang menandai era baru puisi modern Indonesia dengan ekspresi yang ekspresif dan penuh semangat.',
                'book_type' => 'soft',
                'stok' => 8,
            ],
            [
                'name' => 'Catatan Harian Seorang Mahasiswa Revolusioner',
                'author_id' => 4, // Soe Hok Gie
                'publisher_id' => 4, // Bentang Pustaka
                'category_id' => 2, // Non-Fiksi
                'publication_date' => '1983-08-15',
                'description' => 'Catatan pribadi yang menjadi dokumen berharga tentang gerak mahasiswa Indonesia dan analisis sosial yang tajam terhadap kondisi negara.',
                'book_type' => 'soft',
                'stok' => 14,
            ],
            [
                'name' => 'Rumah Kaca',
                'author_id' => 6, // Y.B. Mangunwijaya
                'publisher_id' => 3, // Erlangga
                'category_id' => 1, // Fiksi
                'publication_date' => '1988-04-01',
                'description' => 'Novel yang menceritakan kehidupan keluarga urban dengan tema tentang kebebasan, tanggung jawab, dan makna kebaikan.',
                'book_type' => 'soft',
                'stok' => 16,
            ],
            [
                'name' => 'Jejak Langkah: Otobiografi',
                'author_id' => 8, // Bambang Djoemantoro
                'publisher_id' => 1, // Gramedia Pustaka Utama
                'category_id' => 2, // Non-Fiksi
                'publication_date' => '1995-11-25',
                'description' => 'Autobiografi yang menceritakan perjalanan hidup dan kontribusi penulisnya dalam dunia sastra dan budaya Indonesia.',
                'book_type' => 'hard',
                'stok' => 9,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
