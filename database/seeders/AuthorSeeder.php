<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the authors table dengan data pengarang Indonesia
     */
    public function run(): void
    {
        $authors = [
            [
                'name' => 'Pramoedya Ananta Toer',
                'birth_date' => '1925-02-06',
                'nationality' => 'Indonesia',
                'biography' => 'Pramoedya Ananta Toer adalah salah satu sastrawan Indonesia terbesar yang dikenal dengan karya-karya novelnya yang mengangkat sejarah dan perjuangan Indonesia. Beliau adalah penulis "Tetralogi Pulau Buru" yang merupakan karya monumental dalam sastra Indonesia.',
            ],
            [
                'name' => 'Sutan Sjahrir',
                'birth_date' => '1909-03-06',
                'nationality' => 'Indonesia',
                'biography' => 'Sutan Sjahrir adalah tokoh perjuangan Indonesia dan salah satu founding fathers yang juga dikenal sebagai penulis berbakat. Karyanya banyak membahas tentang ideologi dan pemikiran Indonesia modern.',
            ],
            [
                'name' => 'Chairil Anwar',
                'birth_date' => '1922-07-26',
                'nationality' => 'Indonesia',
                'biography' => 'Chairil Anwar adalah penyair Indonesia legendaris yang terkenal dengan puisi-puisinya yang penuh semangat perjuangan. Beliau dikenal sebagai pelopor puisi modern Indonesia dengan karya-karya yang ekspresif dan dinamis.',
            ],
            [
                'name' => 'Soe Hok Gie',
                'birth_date' => '1942-09-25',
                'nationality' => 'Indonesia',
                'biography' => 'Soe Hok Gie adalah intelektual dan penulis Indonesia yang aktif dalam gerakan mahasiswa dan sosial. Karyanya mencakup essai, buku harian, dan analisis sosial yang mendalam tentang kondisi Indonesia.',
            ],
            [
                'name' => 'Tanah Air Beta',
                'birth_date' => '1927-11-24',
                'nationality' => 'Indonesia',
                'biography' => 'Salah satu pengarang terkenal yang menulis berbagai genre mulai dari fiksi hingga non-fiksi dengan tema-tema yang relevan dengan kehidupan masyarakat Indonesia.',
            ],
            [
                'name' => 'Y.B. Mangunwijaya',
                'birth_date' => '1929-04-11',
                'nationality' => 'Indonesia',
                'biography' => 'Y.B. Mangunwijaya adalah novelis, penyair, dan teolog Indonesia yang terkenal dengan karya-karyanya yang mencerminkan kehidupan masyarakat urban dan isu-isu sosial modern.',
            ],
            [
                'name' => 'Mochtar Lubis',
                'birth_date' => '1923-03-07',
                'nationality' => 'Indonesia',
                'biography' => 'Mochtar Lubis adalah penulis, jurnalis, dan aktivis hak asasi manusia Indonesia. Karyanya termasuk novel "Harimau! Harimau!" yang menjadi karya klasik sastra Indonesia.',
            ],
            [
                'name' => 'Bambang Djoemantoro',
                'birth_date' => '1930-06-15',
                'nationality' => 'Indonesia',
                'biography' => 'Bambang Djoemantoro adalah penulis dan intelektual Indonesia yang menghasilkan berbagai karya dalam bidang sastra, sejarah, dan budaya Indonesia.',
            ],
            [
                'name' => 'Emha Ainun Nadjib',
                'birth_date' => '1953-05-25',
                'nationality' => 'Indonesia',
                'biography' => 'Emha Ainun Nadjib (Cak Nun) adalah penulis, penyair, dan pemikir Indonesia kontemporer yang terkenal dengan karya-karyanya yang filosofis dan humanis.',
            ],
            [
                'name' => 'Andrea Hirata',
                'birth_date' => '1967-10-13',
                'nationality' => 'Indonesia',
                'biography' => 'Andrea Hirata adalah penulis Indonesia modern yang terkenal dengan novel "Laskar Pelangi" yang telah diterjemahkan ke berbagai bahasa dan menjadi bestseller internasional.',
            ],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
