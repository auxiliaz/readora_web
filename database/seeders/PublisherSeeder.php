<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Publisher;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publishers = [
            ['nama' => 'Gramedia Pustaka Utama'],
            ['nama' => 'Mizan'],
            ['nama' => 'Bentang Pustaka'],
            ['nama' => 'Republika Penerbit'],
            ['nama' => 'Erlangga'],
            ['nama' => 'Grasindo'],
            ['nama' => 'Kompas Gramedia'],
            ['nama' => 'Noura Books'],
            ['nama' => 'Gagas Media'],
            ['nama' => 'Penerbit Haru'],
            ['nama' => 'Penerbit Buku Kompas'],
            ['nama' => 'Penerbit Andi'],
            ['nama' => 'Penerbit Qanita'],
            ['nama' => 'Penerbit Hikmah'],
            ['nama' => 'Penerbit Diva Press'],
        ];

        foreach ($publishers as $publisher) {
            Publisher::create($publisher);
        }
    }
}
