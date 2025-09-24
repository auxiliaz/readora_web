<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            ['nama' => 'Tere Liye'],
            ['nama' => 'Dee Lestari'],
            ['nama' => 'Raditya Dika'],
            ['nama' => 'Pidi Baiq'],
            ['nama' => 'Fiersa Besari'],
            ['nama' => 'Boy Candra'],
            ['nama' => 'Ika Natassa'],
            ['nama' => 'Eka Kurniawan'],
            ['nama' => 'Henry Manampiring'],
            ['nama' => 'Brian Krisna'],
            ['nama' => 'Pramoedya Ananta Toer'],
            ['nama' => 'Leila S. Chudori'],
            ['nama' => 'Chairil Anwar'],
            ['nama' => 'Intan Paramaditha'],
            ['nama' => 'Keigo Higashino'],
            ['nama' => 'Andrea Hirata'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
