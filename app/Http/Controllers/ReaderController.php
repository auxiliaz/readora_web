<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use App\Models\Note;
use App\Http\Requests\NoteRequest;
use Illuminate\Http\Response;

class ReaderController extends Controller
{
    /**
     * Display the PDF reader for a book.
     */
    public function show($bookId)
    {
        // Check if user owns this book
        $book = Auth::user()->libraryBooks()
            ->where('books.id', $bookId)
            ->firstOrFail();
        
        // Get user's notes for this book
        $notes = Auth::user()->notes()
            ->where('book_id', $bookId)
            ->orderBy('page_number')
            ->get();
        
        return view('reader.show', compact('book', 'notes'));
    }

    /**
     * Serve the PDF file securely.
     */
    public function servePdf($bookId)
    {
        // Check if user owns this book
        $book = Auth::user()->libraryBooks()
            ->where('books.id', $bookId)
            ->firstOrFail();
        
        // Check if file exists
        if (!$book->file_path || !Storage::disk('public')->exists($book->file_path)) {
            abort(404, 'PDF file not found');
        }
        
        // Serve the PDF file
        $file = Storage::disk('public')->get($book->file_path);
        
        return response($file, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $book->title . '.pdf"')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0')
            ->header('Accept-Ranges', 'bytes'); // Add support for range requests for better PDF.js compatibility
    }

    // saveNote method removed

    // updateNote method removed

    // deleteNote method removed

    // getNotes method removed
}
