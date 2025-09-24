<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;

class TestLibraryFunction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:library {user_id} {book_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test library function by adding a book to user library';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->argument('user_id');
        $bookId = $this->argument('book_id');

        $user = User::find($userId);
        $book = Book::find($bookId);

        if (!$user) {
            $this->error("User with ID {$userId} not found");
            return 1;
        }

        if (!$book) {
            $this->error("Book with ID {$bookId} not found");
            return 1;
        }

        $this->info("Testing library function...");
        $this->info("User: {$user->name} (ID: {$user->id})");
        $this->info("Book: {$book->title} (ID: {$book->id})");

        // Check if book is already in library
        if ($user->hasBookInLibrary($bookId)) {
            $this->warn("Book is already in user's library");
        } else {
            $this->info("Adding book to library...");
            $user->libraryBooks()->attach($bookId);
            $this->info("Book added successfully!");
        }

        // Verify the book is now in library
        $libraryBooks = $user->libraryBooks()->get();
        $this->info("Total books in library: " . $libraryBooks->count());
        
        foreach ($libraryBooks as $libraryBook) {
            $this->line("- {$libraryBook->title}");
        }

        return 0;
    }
}
