<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display the user's wishlist.
     */
    public function index()
    {
        $wishlistItems = Auth::user()->wishlistBooks()->with('category', 'reviews')->get();
        
        return view('wishlist.index', compact('wishlistItems'));
    }

    /**
     * Add a book to the wishlist.
     */
    public function add(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id'
        ]);

        $book = Book::findOrFail($request->book_id);
        
        // Check if user already owns this book
        if (Auth::user()->hasBookInLibrary($book->id)) {
            return response()->json([
                'success' => false,
                'message' => 'You already own this book.'
            ], 400);
        }

        // Check if book is already in wishlist
        if (Auth::user()->hasBookInWishlist($book->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Book is already in your wishlist.'
            ], 400);
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Book added to wishlist successfully!',
            'in_wishlist' => true
        ]);
    }

    /**
     * Remove a book from the wishlist.
     */
    public function remove(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id'
        ]);

        $wishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('book_id', $request->book_id)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Book removed from wishlist!',
                'in_wishlist' => false
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Book not found in wishlist.'
        ], 404);
    }

    /**
     * Move book from wishlist to cart.
     */
    public function moveToCart(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id'
        ]);
        
        $user = Auth::user();
        $bookId = $request->book_id;
        
        // Check if book is in wishlist
        $wishlistItem = $user->wishlistBooks()->where('book_id', $bookId)->first();
        
        if (!$wishlistItem) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found in wishlist'
            ], 404);
        }
        
        // Add to cart
        $cart = $user->getOrCreateCart();
        $existingCartItem = $cart->cartItems()->where('book_id', $bookId)->first();
        
        if ($existingCartItem) {
            $existingCartItem->increment('quantity');
        } else {
            $cart->cartItems()->create([
                'book_id' => $bookId,
                'quantity' => 1
            ]);
        }
        
        // Remove from wishlist
        $user->wishlistBooks()->detach($bookId);
        
        return response()->json([
            'success' => true,
            'message' => 'Book moved to cart successfully!'
        ]);
    }
    
    /**
     * Get wishlist count for authenticated user.
     */
    public function count()
    {
        $count = Auth::user()->wishlistBooks()->count();
        
        return response()->json([
            'count' => $count
        ]);
    }

    /**
     * Toggle wishlist status for a book.
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id'
        ]);

        $book = Book::findOrFail($request->book_id);
        
        // Check if user already owns this book
        if (Auth::user()->hasBookInLibrary($book->id)) {
            return response()->json([
                'success' => false,
                'message' => 'You already own this book.'
            ], 400);
        }

        $wishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->first();

        if ($wishlistItem) {
            // Remove from wishlist
            $wishlistItem->delete();
            return response()->json([
                'success' => true,
                'message' => 'Book removed from wishlist!',
                'in_wishlist' => false
            ]);
        } else {
            // Add to wishlist
            Wishlist::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Book added to wishlist!',
                'in_wishlist' => true
            ]);
        }
    }
}
