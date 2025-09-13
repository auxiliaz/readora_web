<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        
        $books = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'description' => 'A classic American novel set in the Jazz Age, exploring themes of wealth, love, and the American Dream.',
                'price' => 125000,
                'category_id' => $categories->where('name', 'Fiction')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop',
                'file_path' => 'books/the-great-gatsby.pdf',
                'sales_count' => 1250,
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'description' => 'A gripping tale of racial injustice and childhood innocence in the American South.',
                'price' => 135000,
                'category_id' => $categories->where('name', 'Fiction')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop',
                'file_path' => 'books/to-kill-a-mockingbird.pdf',
                'sales_count' => 980,
            ],
            [
                'title' => 'Dune',
                'author' => 'Frank Herbert',
                'description' => 'An epic science fiction novel about politics, religion, and ecology on a desert planet.',
                'price' => 175000,
                'category_id' => $categories->where('name', 'Science Fiction')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=600&fit=crop',
                'file_path' => 'books/dune.pdf',
                'sales_count' => 2100,
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'description' => 'A fantasy adventure following Bilbo Baggins on an unexpected journey.',
                'price' => 145000,
                'category_id' => $categories->where('name', 'Fantasy')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=600&fit=crop',
                'file_path' => 'books/the-hobbit.pdf',
                'sales_count' => 1850,
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'description' => 'A romantic novel about Elizabeth Bennet and her complex relationship with Mr. Darcy.',
                'price' => 115000,
                'category_id' => $categories->where('name', 'Romance')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=600&fit=crop',
                'file_path' => 'books/pride-and-prejudice.pdf',
                'sales_count' => 1420,
            ],
            [
                'title' => 'The Girl with the Dragon Tattoo',
                'author' => 'Stieg Larsson',
                'description' => 'A gripping mystery thriller about a journalist and a hacker investigating a disappearance.',
                'price' => 155000,
                'category_id' => $categories->where('name', 'Mystery & Thriller')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop',
                'file_path' => 'books/girl-with-dragon-tattoo.pdf',
                'sales_count' => 890,
            ],
            [
                'title' => 'Steve Jobs',
                'author' => 'Walter Isaacson',
                'description' => 'The definitive biography of Apple co-founder Steve Jobs.',
                'price' => 185000,
                'category_id' => $categories->where('name', 'Biography')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=600&fit=crop',
                'file_path' => 'books/steve-jobs.pdf',
                'sales_count' => 1650,
            ],
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'description' => 'A thought-provoking exploration of human history and our species\' impact on the world.',
                'price' => 195000,
                'category_id' => $categories->where('name', 'History')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop',
                'file_path' => 'books/sapiens.pdf',
                'sales_count' => 2850,
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'description' => 'A practical guide to building good habits and breaking bad ones.',
                'price' => 165000,
                'category_id' => $categories->where('name', 'Self-Help')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop',
                'file_path' => 'books/atomic-habits.pdf',
                'sales_count' => 3200,
            ],
            [
                'title' => 'The Lean Startup',
                'author' => 'Eric Ries',
                'description' => 'A revolutionary approach to building and managing startups.',
                'price' => 175000,
                'category_id' => $categories->where('name', 'Business')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop',
                'file_path' => 'books/lean-startup.pdf',
                'sales_count' => 1950,
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'description' => 'A handbook of agile software craftsmanship for programmers.',
                'price' => 205000,
                'category_id' => $categories->where('name', 'Technology')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?w=400&h=600&fit=crop',
                'file_path' => 'books/clean-code.pdf',
                'sales_count' => 1100,
            ],
            [
                'title' => 'The 4-Hour Workweek',
                'author' => 'Timothy Ferriss',
                'description' => 'Escape the 9-5, live anywhere, and join the new rich.',
                'price' => 155000,
                'category_id' => $categories->where('name', 'Self-Help')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=600&fit=crop',
                'file_path' => 'books/4-hour-workweek.pdf',
                'sales_count' => 2400,
            ],
            [
                'title' => 'Becoming',
                'author' => 'Michelle Obama',
                'description' => 'The intimate memoir of the former First Lady of the United States.',
                'price' => 185000,
                'category_id' => $categories->where('name', 'Biography')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=600&fit=crop',
                'file_path' => 'books/becoming.pdf',
                'sales_count' => 2750,
            ],
            [
                'title' => 'The Midnight Library',
                'author' => 'Matt Haig',
                'description' => 'A novel about life, death, and all the lives in between.',
                'price' => 145000,
                'category_id' => $categories->where('name', 'Fiction')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=600&fit=crop',
                'file_path' => 'books/midnight-library.pdf',
                'sales_count' => 1680,
            ],
            [
                'title' => 'Where the Crawdads Sing',
                'author' => 'Delia Owens',
                'description' => 'A coming-of-age mystery set in the marshlands of North Carolina.',
                'price' => 155000,
                'category_id' => $categories->where('name', 'Fiction')->first()->id,
                'cover_image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=600&fit=crop',
                'file_path' => 'books/where-crawdads-sing.pdf',
                'sales_count' => 2200,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
