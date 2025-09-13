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
            ['name' => 'Fiction'],
            ['name' => 'Non-Fiction'],
            ['name' => 'Science Fiction'],
            ['name' => 'Fantasy'],
            ['name' => 'Romance'],
            ['name' => 'Mystery & Thriller'],
            ['name' => 'Biography'],
            ['name' => 'History'],
            ['name' => 'Self-Help'],
            ['name' => 'Business'],
            ['name' => 'Technology'],
            ['name' => 'Health & Fitness'],
            ['name' => 'Travel'],
            ['name' => 'Cooking'],
            ['name' => 'Art & Design'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
