<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display books by category with filtering and search.
     */
    public function categories(Request $request)
    {
        $categories = Category::withCount('books')->get();
        
        $query = Book::with('category', 'reviews', 'author');
        
        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        // Search by title or author
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhereHas('author', function($authorQuery) use ($searchTerm) {
                      $authorQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }
        
        // Sort options
        switch ($request->get('sort', 'latest')) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->orderBy('sales_count', 'desc');
                break;
            case 'rating':
                $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        
        $books = $query->paginate(12)->withQueryString();
        
        return view('books.categories', compact('books', 'categories'));
    }
    
    /**
     * Display a specific book's details.
     */
    public function show($id)
    {
        $book = Book::with(['category', 'author', 'publisher', 'reviews.user'])->findOrFail($id);
        
        // Get related books from the same category
        $relatedBooks = Book::with('category', 'author', 'publisher')
            ->where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->limit(4)
            ->get();
        
        return view('books.show', compact('book', 'relatedBooks'));
    }
}
