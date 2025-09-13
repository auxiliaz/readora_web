<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the user's cart.
     */
    public function index()
    {
        $cart = Auth::user()->cart()->with('cartItems.book')->first();
        $cartItems = $cart ? $cart->cartItems : collect();
        
        return view('cart.index', compact('cartItems', 'cart'));
    }

    /**
     * Add a book to the cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'integer|min:1|max:10'
        ]);

        $book = Book::findOrFail($request->book_id);
        $cart = Auth::user()->getOrCreateCart();
        
        // Check if user already owns this book
        if (Auth::user()->hasBookInLibrary($book->id)) {
            return response()->json([
                'success' => false,
                'message' => 'You already own this book.'
            ], 400);
        }

        // Check if book is already in cart
        $existingItem = $cart->cartItems()->where('book_id', $book->id)->first();
        
        if ($existingItem) {
            $existingItem->update([
                'quantity' => $existingItem->quantity + ($request->quantity ?? 1)
            ]);
        } else {
            $cart->cartItems()->create([
                'book_id' => $book->id,
                'quantity' => $request->quantity ?? 1
            ]);
        }

        $cartCount = $cart->cartItems()->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Book added to cart successfully!',
            'cart_count' => $cartCount
        ]);
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        $cartItem = CartItem::where('id', $itemId)
            ->whereHas('cart', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully!',
            'subtotal' => $cartItem->subtotal,
            'total' => $cartItem->cart->total_amount
        ]);
    }

    /**
     * Remove item from cart.
     */
    public function remove($itemId)
    {
        $cartItem = CartItem::where('id', $itemId)
            ->whereHas('cart', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        $cartItem->delete();

        $cart = Auth::user()->cart;
        $cartCount = $cart ? $cart->cartItems()->sum('quantity') : 0;

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart!',
            'cart_count' => $cartCount,
            'total' => $cart ? $cart->total_amount : 0
        ]);
    }

    /**
     * Clear all items from cart.
     */
    public function clear()
    {
        $cart = Auth::user()->cart;
        
        if ($cart) {
            $cart->cartItems()->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully!',
            'cart_count' => 0
        ]);
    }

    /**
     * Get cart count for navbar.
     */
    public function count()
    {
        $cart = Auth::user()->cart;
        $count = $cart ? $cart->cartItems()->sum('quantity') : 0;

        return response()->json(['count' => $count]);
    }
}
