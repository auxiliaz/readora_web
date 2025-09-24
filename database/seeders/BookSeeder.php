<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $authors = Author::all();
        $publishers = Publisher::all();
        
        $books = [
            [
                'title' => 'Laskar Pelangi',
                'isbn' => '978-602-03-1234-5',
                'author_id' => $authors->where('nama', 'Andrea Hirata')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Bentang Pustaka')->first()->id,
                'description' => 'Novel tentang perjuangan anak-anak Belitung untuk mendapatkan pendidikan.',
                'price' => 85000,
                'category_id' => $categories->where('name', 'Fiksi')->first()->id,
                'cover_image' => 'covers/laskarpelangi.jpg',
                'file_path' => 'books/laskar-pelangi.pdf',
                'sales_count' => 2500,
            ],
            [
                'title' => 'Bumi',
                'isbn' => '978-602-03-2345-6',
                'author_id' => $authors->where('nama', 'Tere Liye')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Gramedia Pustaka Utama')->first()->id,
                'description' => 'Namaku Raib, usiaku 15 tahun, kelas sepuluh. Aku anak perempuan seperti kalian, adik-adik kalian, tetangga kalian. Aku punya dua kucing, namanya si Putih dan si Hitam. Mama dan papaku menyenangkan. Guru-guru di sekolahku seru, teman-temanku baik dan kompak. Aku sama seperti remaja kebanyakan, kecuali satu hal. Sesuatu yang kusimpan sendiri sejak kecil. Sesuatu yang menakjubkan. Namaku Raib. Dan aku bisa menghilang.',
                'price' => 75000,
                'category_id' => $categories->where('name', 'Fantasi')->first()->id,
                'cover_image' => 'covers/bumi_tereliye.jpg',
                'file_path' => 'books/Tere_Liye_Bumi.pdf',
                'sales_count' => 3200,
            ],
            [
                'title' => 'Supernova: Kesatria, Putri, dan Bintang Jatuh',
                'isbn' => '978-602-03-3456-7',
                'author_id' => $authors->where('nama', 'Dee Lestari')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Bentang Pustaka')->first()->id,
                'description' => 'Menunaikan ikrar mereka untuk berkarya bersama, pasangan Dimas dan Reuben mulai menulis roman yang diberi judul Kesatria, Putri, dan Bintang Jatuh. Paralel dengan itu, dalam kehidupan nyata, sebuah kisah cinta terlarang terjalin antara Ferre dan Rana. Hubungan cinta mereka merepresentasikan dinamika yang terjadi antara tokoh Kesatria dan Putri dalam fiksi Dimas dan Reuben. Tokoh ketiga, Bintang Jatuh, dihadirkan oleh seorang peragawati terkenal bernama Diva, yang memiliki profesi sampingan sebagai pelacur kelas atas. Tanpa ada yang bisa mengantisipasi, kehadiran sosok bernama Supernova menjadi kunci penentu yang akhirnya merajut kehidupan nyata antara Ferre-Rana-Diva dengan kisah fiksi karya Dimas-Reuben dalam satu dimensi kehidupan yang sama.',
                'price' => 95000,
                'category_id' => $categories->where('name', 'Fiksi Ilmiah')->first()->id,
                'cover_image' => 'covers/super.jpg',
                'file_path' => 'books/supernova.pdf',
                'sales_count' => 1800,
            ],
            [
                'title' => 'Cantik Itu Luka',
                'isbn' => '978-602-03-4567-8',
                'author_id' => $authors->where('nama', 'Eka Kurniawan')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Gramedia Pustaka Utama')->first()->id,
                'description' => 'Di akhir masa kolonial, seorang perempuan dipaksa menjadi pelacur. Kehidupan itu terus dijalaninya hingga ia memiliki tiga anak gadis yang kesemuanya cantik. Ketika mengandung anaknya yang keempat, ia berharap anak itu akan lahir buruk rupa. Itulah yang terjadi, meskipun secara ironik ia memberinya nama Si Cantik.',
                'price' => 65000,
                'category_id' => $categories->where('name', 'Fiksi')->first()->id,
                'cover_image' => 'covers/cantik.jpeg',
                'file_path' => 'books/kambing-jantan.pdf',
                'sales_count' => 2100,
            ],
            [
                'title' => 'Laut Bercerita',
                'isbn' => '978-602-03-5678-9',
                'author_id' => $authors->where('nama', 'Leila S. Chudori')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Mizan')->first()->id,
                'description' => 'Novel ini mengupas peristiwa reformasi dan nilai sejarah melalui perspektif aktivis, ketidakadilan, dan pengalaman manusia di tengah pergolakan politik. Lebih dari sekadar narasi sejarah, ini tentang suara-suara yang sering terlupakan hingga kemudian bersuara melalui karya sastra.',
                'price' => 70000,
                'category_id' => $categories->where('name', 'Sejarah')->first()->id,
                'cover_image' => 'covers/laut.jpeg',
                'file_path' => 'books/dilan-1990.pdf',
                'sales_count' => 4500,
            ],
            [
                'title' => 'Tentang Kamu',
                'isbn' => '978-602-03-6789-0',
                'author_id' => $authors->where('nama', 'Tere Liye')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Gramedia Pustaka Utama')->first()->id,
                'description' => 'Kisah tentang seorang perempuan miskin sederhana yang penuh perjuangan, sabar dan tangguh, yang akhirnya mencapai keadaan luar biasa — menjadi sangat kaya. Ceritanya melintasi berbagai lokasi: Pulau Bungin, Sumbawa, Solo, Jakarta, London, Paris.',
                'price' => 55000,
                'category_id' => $categories->where('name', 'Romansa')->first()->id,
                'cover_image' => 'covers/tentangkamu.jpeg',
                'file_path' => 'books/garis-waktu.pdf',
                'sales_count' => 1600,
            ],
            [
                'title' => 'Malice (Catatan Pembunuhan Sang Novelis)',
                'isbn' => '978-602-03-8901-2',
                'author_id' => $authors->where('nama', 'Keigo Higashino')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Gramedia Pustaka Utama')->first()->id,
                'description' => 'Hidaka Kunihiko, seorang novelis, ditemukan tewas di ruang kerjanya yang terkunci. Detektif Kaga menyelidiki dan menemukan bahwa hubungan korban dengan sahabat dan istri menyimpan rahasia. Motif pembunuhan bukan hanya tentang siapa & bagaimana, tapi kenapa.',
                'price' => 80000,
                'category_id' => $categories->where('name', 'Misteri & Thriller')->first()->id,
                'cover_image' => 'covers/malice.jpeg',
                'file_path' => 'books/critical-eleven.pdf',
                'sales_count' => 2200,
            ],
            [
                'title' => 'Keajaiban Toko Kelontong Namiya',
                'isbn' => '978-602-03-9012-3',
                'author_id' => $authors->where('nama', 'Keigo Higashino')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Gramedia Pustaka Utama')->first()->id,
                'description' => 'Toko kelontong Namiya sudah lama tak berpenghuni. Suatu malam, tiga pemuda yang sedang bersembunyi di sana menemukan sepucuk surat misterius yang masuk lewat lubang surat. Surat itu bukan sembarang surat: pengirimnya meminta nasihat tentang masalah hidupnya. Petualangan melintasi waktu dan jejak masa lalu pun muncul melalui nasihat-nasihat dari kakek toko itu. Semalam itu akan mengubah hidup mereka selamanya.',
                'price' => 75000,
                'category_id' => $categories->where('name', 'Fantasi')->first()->id,
                'cover_image' => 'covers/toko.jpeg',
                'file_path' => 'books/assalamualaikum-beijing.pdf',
                'sales_count' => 1700,
            ],
            [
                'title' => 'Seporsi Mie Ayam Sebelum Mati',
                'isbn' => '978-602-03-0123-4',
                'author_id' => $authors->where('nama', 'Brian Krisna')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Republika Penerbit')->first()->id,
                'description' => 'Ale, seorang lelaki berusia 37 tahun yang didiagnosa mengidap depresi akut ingin mengakhiri hidupnya. Ale merasa tak pernah bisa memilih sesuatu atas kehendaknya sendiri. Namun sebelum mati, ia ingin makan seporsi mie ayam terakhirnya, setidaknya itu adalah keputusan yang ia ambil atas kehendaknya sendiri. Blurb: Seperti malam-malam lain, aku pulang selepas lembur. Orang-orang di kantor yang sudah menikah, mereka akan pulang ke keluarganya masing-masing. Sementara aku yang tidak punya siapa-siapa ini, sekarang masih duduk sendirian di parkiran mobil yang sudah lengang, bersama sebotol bir, rokok murah, dan sepotong kue ulang tahunku sendiri yang kubeli dari toko manisan dekat kantor.Aku takut kalau ternyata selama ini aku tidak pernah berhasil menjalani hidup seperti sebagaimana seharusnya. Di kepalaku sekarang, pertanyaan ini semakin lama semakin membesar. “Pantaskah hidup ini kulanjutkan?” Aku berdiri menatap ke langit malam. Kini tekadku sudah bulat. Aku akan bunuh diri 24 jam dari sekarang.',
                'price' => 50000,
                'category_id' => $categories->where('name', 'Fiksi')->first()->id,
                'cover_image' => 'covers/mieayam.jpg',
                'file_path' => 'books/ayat-ayat-cinta.pdf',
                'sales_count' => 3800,
            ],
            [
                'title' => 'Filosofi Teras',
                'isbn' => '978-602-03-1357-9',
                'author_id' => $authors->where('nama', 'Henry Manampiring')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Gramedia Pustaka Utama')->first()->id,
                'description' => 'Menjelaskan bagaimana filosofi Stoisisme bisa membantu kita mengendalikan emosi, hidup lebih bijak dan tenang, meskipun bahasanya ringan dan mudah dicerna. Cocok bagi yang ingin introspeksi atau belajar ketahanan mental lewat sudut pandang filosofi klasik.',
                'price' => 90000,
                'category_id' => $categories->where('name', 'Pengembangan Diri')->first()->id,
                'cover_image' => 'covers/filosofi.png',
                'file_path' => 'books/ronggeng-dukuh-paruk.pdf',
                'sales_count' => 1400,
            ],
            [
                'title' => 'Bumi Manusia',
                'isbn' => '978-602-03-2468-0',
                'author_id' => $authors->where('nama', 'Pramoedya Ananta Toer')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Penerbit Buku Kompas')->first()->id,
                'description' => 'Novel sejarah tentang perjuangan bangsa Indonesia melawan kolonialisme.',
                'price' => 95000,
                'category_id' => $categories->where('name', 'Sejarah')->first()->id,
                'cover_image' => 'covers/manusia.jpg',
                'file_path' => 'books/bumi-manusia.pdf',
                'sales_count' => 2800,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
