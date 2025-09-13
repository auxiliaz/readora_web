<?php
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Book;
use App\Models\User;

// Get or create a test book
$book = Book::first();
if (!$book) {
    $book = Book::create([
        'title' => 'Bumi - Tere Liye',
        'author' => 'Tere Liye',
        'description' => 'Novel fantasi tentang petualangan Raib, Ali, dan Seli di dunia paralel.',
        'price' => 75000,
        'category_id' => 1,
        'file_path' => 'books/Tere_Liye_Bumi.pdf',
        'cover_image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop',
        'sales_count' => 0
    ]);
    echo "Created new book: {$book->title}\n";
} else {
    // Update existing book to use the PDF
    $book->file_path = 'books/Tere_Liye_Bumi.pdf';
    $book->save();
    echo "Updated book: {$book->title} with PDF path\n";
}

// Add book to user's library
$user = User::first();
if ($user && !$user->libraryBooks()->where('book_id', $book->id)->exists()) {
    $user->libraryBooks()->attach($book->id);
    echo "Added book to user's library\n";
}

echo "Book ID: {$book->id}\n";
echo "PDF Path: {$book->file_path}\n";
echo "Reader URL: http://localhost:8000/reader/{$book->id}\n";
echo "Library URL: http://localhost:8000/library\n";
?>
