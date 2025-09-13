<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class DebugController extends Controller
{
    public function testCartWishlist()
    {
        $books = Book::with('category')->take(5)->get();
        
        return view('debug.test-buttons', compact('books'));
    }
}
