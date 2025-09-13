<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the landing page.
     */
    public function index()
    {
        // Get popular books (based on sales count)
        $popularBooks = Book::with('category', 'reviews')
            ->orderBy('sales_count', 'desc')
            ->limit(8)
            ->get();

        // Get latest releases
        $latestBooks = Book::with('category', 'reviews')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        // Get recent reviews with user and book info
        $recentReviews = Review::with('user', 'book')
            ->whereNotNull('review_text')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('home', compact('popularBooks', 'latestBooks', 'recentReviews'));
    }
}
