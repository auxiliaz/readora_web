<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Get basic stats
        $totalBooks = Book::count();
        $totalCategories = Category::count();
        $currentMonth = Carbon::now()->format('Y-m');
        $booksSoldThisMonth = Order::successful()
            ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$currentMonth])
            ->withCount('orderItems')
            ->get()
            ->sum('order_items_count');

        // Get recent reviews
        $recentReviews = Review::with(['user', 'book'])
            ->latest()
            ->take(5)
            ->get();

        // Get top selling books
        $topBooks = Book::orderBy('sales_count', 'desc')
            ->take(5)
            ->get();

        // Get monthly sales data for chart
        $monthlySales = Order::successful()
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count, SUM(total_amount) as total')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->take(12)
            ->get();

        // Get category distribution
        $categoryStats = Category::withCount('books')->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalCategories', 
            'booksSoldThisMonth',
            'recentReviews',
            'topBooks',
            'monthlySales',
            'categoryStats'
        ));
    }
}
