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
                'author' => 'Andrea Hirata',
                'author_id' => $authors->where('nama', 'Andrea Hirata')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Bentang Pustaka')->first()->id,
                'description' => 'Novel tentang perjuangan anak-anak Belitung untuk mendapatkan pendidikan.',
                'price' => 85000,
                'category_id' => $categories->where('name', 'Fiction')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop',
                'file_path' => 'books/laskar-pelangi.pdf',
                'sales_count' => 2500,
            ],
            [
                'title' => 'Bumi',
                'isbn' => '978-602-03-2345-6',
                'author' => 'Tere Liye',
                'author_id' => $authors->where('nama', 'Tere Liye')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Gramedia Pustaka Utama')->first()->id,
                'description' => 'Novel fantasi tentang petualangan Raib, Ali, dan Seli di dunia paralel.',
                'price' => 75000,
                'category_id' => $categories->where('name', 'Fantasy')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=600&fit=crop',
                'file_path' => 'books/bumi.pdf',
                'sales_count' => 3200,
            ],
            [
                'title' => 'Supernova: Kesatria, Putri, dan Bintang Jatuh',
                'isbn' => '978-602-03-3456-7',
                'author' => 'Dee Lestari',
                'author_id' => $authors->where('nama', 'Dee Lestari')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Bentang Pustaka')->first()->id,
                'description' => 'Novel science fiction tentang cinta, fisika kuantum, dan pencarian makna hidup.',
                'price' => 95000,
                'category_id' => $categories->where('name', 'Science Fiction')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=600&fit=crop',
                'file_path' => 'books/supernova.pdf',
                'sales_count' => 1800,
            ],
            [
                'title' => 'Kambing Jantan',
                'isbn' => '978-602-03-4567-8',
                'author' => 'Raditya Dika',
                'author_id' => $authors->where('nama', 'Raditya Dika')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Gagas Media')->first()->id,
                'description' => 'Kumpulan cerita lucu tentang pengalaman hidup yang absurd dan menghibur.',
                'price' => 65000,
                'category_id' => $categories->where('name', 'Fiction')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=600&fit=crop',
                'file_path' => 'books/kambing-jantan.pdf',
                'sales_count' => 2100,
            ],
            [
                'title' => 'Dilan: Dia adalah Dilanku Tahun 1990',
                'isbn' => '978-602-03-5678-9',
                'author' => 'Pidi Baiq',
                'author_id' => $authors->where('nama', 'Pidi Baiq')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Mizan')->first()->id,
                'description' => 'Novel romantis tentang kisah cinta Dilan dan Milea di tahun 1990.',
                'price' => 70000,
                'category_id' => $categories->where('name', 'Romance')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop',
                'file_path' => 'books/dilan-1990.pdf',
                'sales_count' => 4500,
            ],
            [
                'title' => 'Garis Waktu',
                'isbn' => '978-602-03-6789-0',
                'author' => 'Fiersa Besari',
                'author_id' => $authors->where('nama', 'Fiersa Besari')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Penerbit Haru')->first()->id,
                'description' => 'Kumpulan puisi dan prosa tentang perjalanan hidup dan pencarian jati diri.',
                'price' => 55000,
                'category_id' => $categories->where('name', 'Fiction')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop',
                'file_path' => 'books/garis-waktu.pdf',
                'sales_count' => 1600,
            ],
            [
                'title' => 'Senja, Hujan, dan Cerita yang Telah Usai',
                'isbn' => '978-602-03-7890-1',
                'author' => 'Boy Candra',
                'author_id' => $authors->where('nama', 'Boy Candra')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Penerbit Haru')->first()->id,
                'description' => 'Kumpulan puisi tentang cinta, kehilangan, dan harapan.',
                'price' => 50000,
                'category_id' => $categories->where('name', 'Fiction')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=600&fit=crop',
                'file_path' => 'books/senja-hujan.pdf',
                'sales_count' => 1900,
            ],
            [
                'title' => 'Critical Eleven',
                'isbn' => '978-602-03-8901-2',
                'author' => 'Ika Natassa',
                'author_id' => $authors->where('nama', 'Ika Natassa')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Gramedia Pustaka Utama')->first()->id,
                'description' => 'Novel tentang cinta yang diuji oleh waktu dan keadaan.',
                'price' => 80000,
                'category_id' => $categories->where('name', 'Romance')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?w=400&h=600&fit=crop',
                'file_path' => 'books/critical-eleven.pdf',
                'sales_count' => 2200,
            ],
            [
                'title' => 'Assalamualaikum Beijing',
                'isbn' => '978-602-03-9012-3',
                'author' => 'Asma Nadia',
                'author_id' => $authors->where('nama', 'Asma Nadia')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Republika Penerbit')->first()->id,
                'description' => 'Novel tentang perjalanan spiritual seorang muslimah di Beijing.',
                'price' => 75000,
                'category_id' => $categories->where('name', 'Fiction')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop',
                'file_path' => 'books/assalamualaikum-beijing.pdf',
                'sales_count' => 1700,
            ],
            [
                'title' => 'Ayat-Ayat Cinta',
                'isbn' => '978-602-03-0123-4',
                'author' => 'Habiburrahman El Shirazy',
                'author_id' => $authors->where('nama', 'Habiburrahman El Shirazy')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Republika Penerbit')->first()->id,
                'description' => 'Novel islami tentang cinta, kehidupan, dan perjuangan seorang mahasiswa Indonesia di Mesir.',
                'price' => 85000,
                'category_id' => $categories->where('name', 'Romance')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=600&fit=crop',
                'file_path' => 'books/ayat-ayat-cinta.pdf',
                'sales_count' => 3800,
            ],
            [
                'title' => 'Ronggeng Dukuh Paruk',
                'isbn' => '978-602-03-1357-9',
                'author' => 'Ahmad Tohari',
                'author_id' => $authors->where('nama', 'Ahmad Tohari')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Gramedia Pustaka Utama')->first()->id,
                'description' => 'Novel tentang kehidupan seorang ronggeng di desa Dukuh Paruk.',
                'price' => 90000,
                'category_id' => $categories->where('name', 'Fiction')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=600&fit=crop',
                'file_path' => 'books/ronggeng-dukuh-paruk.pdf',
                'sales_count' => 1400,
            ],
            [
                'title' => 'Bumi Manusia',
                'isbn' => '978-602-03-2468-0',
                'author' => 'Pramoedya Ananta Toer',
                'author_id' => $authors->where('nama', 'Pramoedya Ananta Toer')->first()->id,
                'publisher_id' => $publishers->where('nama', 'Penerbit Buku Kompas')->first()->id,
                'description' => 'Novel sejarah tentang perjuangan bangsa Indonesia melawan kolonialisme.',
                'price' => 95000,
                'category_id' => $categories->where('name', 'History')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop',
                'file_path' => 'books/bumi-manusia.pdf',
                'sales_count' => 2800,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
