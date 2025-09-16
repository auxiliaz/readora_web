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
            ['nama' => 'Andrea Hirata'],
            ['nama' => 'Dee Lestari'],
            ['nama' => 'Raditya Dika'],
            ['nama' => 'Pidi Baiq'],
            ['nama' => 'Fiersa Besari'],
            ['nama' => 'Boy Candra'],
            ['nama' => 'Ika Natassa'],
            ['nama' => 'Asma Nadia'],
            ['nama' => 'Habiburrahman El Shirazy'],
            ['nama' => 'Ahmad Tohari'],
            ['nama' => 'Pramoedya Ananta Toer'],
            ['nama' => 'Sapardi Djoko Damono'],
            ['nama' => 'Chairil Anwar'],
            ['nama' => 'Seno Gumira Ajidarma'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
