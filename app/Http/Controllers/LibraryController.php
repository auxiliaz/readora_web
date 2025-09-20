<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    /**
     * Display the user's library.
     */
    public function index()
    {
        $libraryBooks = Auth::user()->libraryBooks()
            ->with(['category', 'author', 'publisher', 'reviews'])
            ->orderBy('library.created_at', 'desc')
            ->get();
        
        return view('library.index', compact('libraryBooks'));
    }

    /**
     * Show reading progress and notes for a specific book.
     */
    public function show($bookId)
    {
        $book = Auth::user()->libraryBooks()
            ->with(['category', 'author', 'publisher', 'reviews.user'])
            ->where('books.id', $bookId)
            ->firstOrFail();
        
        // Get user's notes for this book
        $notes = Auth::user()->notes()
            ->where('book_id', $bookId)
            ->orderBy('page_number')
            ->get();
        
        return view('library.show', compact('book', 'notes'));
    }
}
