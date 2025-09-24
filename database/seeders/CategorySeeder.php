<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiksi'],
            ['name' => 'Fiksi Ilmiah'],
            ['name' => 'Fantasi'],
            ['name' => 'Romansa'],
            ['name' => 'Misteri & Thriller'],
            ['name' => 'Biografi'],
            ['name' => 'Sejarah'],
            ['name' => 'Pengembangan Diri'],
            ['name' => 'Bisnis'],
            ['name' => 'Teknologi'],
            ['name' => 'Kesehatan'],
            ['name' => 'Memasak'],
            ['name' => 'Seni & Desain'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
