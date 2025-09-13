<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class SearchController extends Controller
{
    /**
     * Handle search requests.
     */
    public function index(Request $request)
    {
        $query = $request->get('q');
        $categoryId = $request->get('category');
        $sortBy = $request->get('sort', 'relevance');
        $perPage = 12;
        
        if (empty($query)) {
            return redirect('/categories')->with('error', 'Please enter a search term.');
        }
        
        // Build the search query
        $booksQuery = Book::with(['category', 'reviews'])
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('author', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            });
        
        // Filter by category if specified
        if ($categoryId) {
            $booksQuery->where('category_id', $categoryId);
        }
        
        // Apply sorting
        switch ($sortBy) {
            case 'price_low':
                $booksQuery->orderBy('price', 'asc');
                break;
            case 'price_high':
                $booksQuery->orderBy('price', 'desc');
                break;
            case 'newest':
                $booksQuery->orderBy('created_at', 'desc');
                break;
            case 'popular':
                $booksQuery->orderBy('sales_count', 'desc');
                break;
            case 'rating':
                $booksQuery->orderByRaw('(SELECT AVG(rating) FROM reviews WHERE book_id = books.id) DESC NULLS LAST');
                break;
            case 'title':
                $booksQuery->orderBy('title', 'asc');
                break;
            default: // relevance
                // Order by exact title matches first, then partial matches
                $booksQuery->orderByRaw("
                    CASE 
                        WHEN title LIKE '{$query}%' THEN 1
                        WHEN title LIKE '%{$query}%' THEN 2
                        WHEN author LIKE '{$query}%' THEN 3
                        WHEN author LIKE '%{$query}%' THEN 4
                        ELSE 5
                    END
                ");
                break;
        }
        
        $books = $booksQuery->paginate($perPage);
        $categories = Category::orderBy('name')->get();
        
        // Get search statistics
        $totalResults = $books->total();
        
        return view('search.results', compact('books', 'categories', 'query', 'categoryId', 'sortBy', 'totalResults'));
    }
    
    /**
     * Get search suggestions via AJAX.
     */
    public function suggestions(Request $request)
    {
        $query = $request->get('q');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }
        
        $suggestions = Book::select('title', 'author', 'id')
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('author', 'LIKE', "%{$query}%");
            })
            ->limit(8)
            ->get()
            ->map(function ($book) {
                return [
                    'id' => $book->id,
                    'title' => $book->title,
                    'author' => $book->author,
                    'type' => 'book'
                ];
            });
        
        // Add author suggestions
        $authors = Book::select('author')
            ->where('author', 'LIKE', "%{$query}%")
            ->groupBy('author')
            ->limit(4)
            ->get()
            ->map(function ($item) {
                return [
                    'title' => $item->author,
                    'type' => 'author'
                ];
            });
        
        $allSuggestions = $suggestions->concat($authors)->take(10);
        
        return response()->json($allSuggestions);
    }
}
