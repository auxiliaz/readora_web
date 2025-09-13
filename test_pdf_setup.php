<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Book;
use App\Models\User;

echo "=== PDF Setup Test ===" . PHP_EOL;

// Check existing books
$books = Book::select('id', 'title', 'file_path')->get();
echo "Books in database: " . $books->count() . PHP_EOL;

if ($books->count() > 0) {
    foreach($books->take(3) as $book) {
        echo "ID: {$book->id}, Title: {$book->title}, File: {$book->file_path}" . PHP_EOL;
    }
    
    // Update first book to use existing PDF
    $firstBook = $books->first();
    $firstBook->file_path = 'books/Tere_Liye_Bumi.pdf';
    $firstBook->save();
    echo "Updated book '{$firstBook->title}' with PDF file path" . PHP_EOL;
    
    // Check if user has this book in library
    $user = User::first();
    if ($user) {
        $hasBook = $user->libraryBooks()->where('book_id', $firstBook->id)->exists();
        if (!$hasBook) {
            $user->libraryBooks()->attach($firstBook->id);
            echo "Added book to user's library" . PHP_EOL;
        } else {
            echo "Book already in user's library" . PHP_EOL;
        }
    }
    
    echo "Test book ID: {$firstBook->id}" . PHP_EOL;
    echo "PDF file should be available at: /reader/{$firstBook->id}/pdf" . PHP_EOL;
} else {
    echo "No books found in database. Please run migrations and seeders first." . PHP_EOL;
}

// Check if PDF file exists
$pdfPath = storage_path('app/public/books/Tere_Liye_Bumi.pdf');
if (file_exists($pdfPath)) {
    $fileSize = filesize($pdfPath);
    echo "PDF file exists: " . number_format($fileSize) . " bytes" . PHP_EOL;
} else {
    echo "PDF file not found at: {$pdfPath}" . PHP_EOL;
}

echo "=== End Test ===" . PHP_EOL;
?>
