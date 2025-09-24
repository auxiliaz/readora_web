<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = Auth::user()->cart()->with('cartItems.book.category', 'cartItems.book.author', 'cartItems.book.publisher')->first();
        
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        
        // Handle POST request with selected items
        if ($request->isMethod('post') && $request->has('selected_items')) {
            $selectedItems = $request->input('selected_items', []);
            $request->session()->put('selected_cart_items', $selectedItems);
        } else {
            // Get selected items from session
            $selectedItems = $request->session()->get('selected_cart_items', []);
        }
        
        if (empty($selectedItems)) {
            // If no selection, redirect back to cart
            return redirect()->route('cart.index')->with('error', 'Please select items to checkout.');
        }
        
        // Filter cart items to only selected ones
        $cart->cartItems = $cart->cartItems->whereIn('id', $selectedItems);
        
        return view('checkout.index', compact('cart'));
    }
    public function process(Request $request)
    {
        $cart = Auth::user()->cart()->with('cartItems.book.category', 'cartItems.book.author', 'cartItems.book.publisher')->first();
        
        if (!$cart || $cart->cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty.'
            ], 400);
        }
        
        // Get selected items from request or session
        $selectedItems = $request->input('selected_items', $request->session()->get('selected_cart_items', []));
        if (empty($selectedItems)) {
            return response()->json([
                'success' => false,
                'message' => 'Please select items to checkout.'
            ], 400);
        }
        
        // Filter cart items to only selected ones
        $selectedCartItems = $cart->cartItems->whereIn('id', $selectedItems);
        if ($selectedCartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Selected items not found in cart.'
            ], 400);
        }

        try {
            DB::beginTransaction();

            // Calculate total for selected items only
            $totalAmount = $selectedCartItems->sum(function ($item) {
                return $item->book->price * $item->quantity;
            });
            
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'midtrans_order_id' => 'ORDER-' . time() . '-' . Auth::id()
            ]);

            foreach ($selectedCartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $item->book_id,
                    'price' => $item->book->price,
                    'quantity' => $item->quantity
                ]);
            }

            $serverKey = config('services.midtrans.server_key');
            $clientKey = config('services.midtrans.client_key');
            

            if (empty($serverKey) || empty($clientKey)) {
                throw new \Exception('Midtrans API keys not configured. Please check your .env file.');
            }
            
            if ($serverKey === 'SB-Mid-server-vNEKqIEqMPHHFg52Mh_GWcMn' || $clientKey === 'SB-Mid-client-dEmN5kLwBDO0-Gnh') {
                throw new \Exception('Please replace placeholder API keys with real Midtrans keys from dashboard.');
            }
            
            Config::$serverKey = $serverKey;
            Config::$isProduction = config('services.midtrans.is_production', false);
            Config::$isSanitized = config('services.midtrans.is_sanitized', true);
            Config::$is3ds = config('services.midtrans.is_3ds', true);

            $transactionDetails = [
                'order_id' => $order->midtrans_order_id,
                'gross_amount' => (int) $totalAmount
            ];

            $itemDetails = [];
            foreach ($selectedCartItems as $item) {
                $itemDetails[] = [
                    'id' => $item->book_id,
                    'price' => (int) $item->book->price,
                    'quantity' => $item->quantity,
                    'name' => $item->book->title
                ];
            }

            $customerDetails = [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email
            ];

            $params = [
                'transaction_details' => $transactionDetails,
                'item_details' => $itemDetails,
                'customer_details' => $customerDetails,
                'enabled_payments' => ['credit_card', 'bca_va', 'bni_va', 'bri_va', 'echannel', 'permata_va', 'other_va', 'gopay', 'shopeepay'],
                'callbacks' => [
                    'finish' => route('checkout.success', ['order' => $order->id])
                ]
            ];

            try {
                $snapToken = Snap::getSnapToken($params);
            } catch (\Exception $e) {
                \Log::error('Midtrans Snap Error: ' . $e->getMessage());
                \Log::error('Server Key (first 20 chars): ' . substr($serverKey, 0, 20) . '...');
                throw new \Exception('Midtrans API Error: ' . $e->getMessage());
            }
            $redirectUrl = route('checkout.success', ['order' => $order->id]);

            DB::commit();

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'redirect_url' => $redirectUrl,
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to process checkout: ' . $e->getMessage()
            ], 500);
        }
    }

    public function success(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        \Log::info("User reached success page for order: {$order->id}, status: {$order->status}");

        // Always add books to library when user reaches success page
        // This handles cases where Midtrans callback hasn't been processed yet
        if ($order->status !== 'failed') {
            \Log::info("Adding books to library from success page for order: {$order->id}");
            $this->addBooksToLibrary($order);
            
            // Update order status to success if it's still pending
            if ($order->status === 'pending') {
                $order->update(['status' => 'success']);
                \Log::info("Updated order status to success for order: {$order->id}");
            }
        } else {
            \Log::warning("Order {$order->id} has failed status, not adding books to library");
        }

        return view('checkout.success', compact('order'));
    }
    public function failed(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->update(['status' => 'failed']);

        return view('checkout.failed', compact('order'));
    }

    public function notification(Request $request)
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
        
        $notification = new \Midtrans\Notification();
        
        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status ?? null;

        $order = Order::where('midtrans_order_id', $orderId)->first();

        if (!$order) {
            return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
        }

        \Log::info("Processing Midtrans notification for order: {$orderId}, status: {$transactionStatus}, fraud: {$fraudStatus}");

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $order->update(['status' => 'pending']);
                \Log::info("Order {$order->id} marked as pending due to fraud challenge");
            } else if ($fraudStatus == 'accept') {
                $order->update(['status' => 'success']);
                \Log::info("Order {$order->id} marked as success, adding books to library");
                $this->addBooksToLibrary($order);
            }
        } else if ($transactionStatus == 'settlement') {
            $order->update(['status' => 'success']);
            \Log::info("Order {$order->id} settled, adding books to library");
            $this->addBooksToLibrary($order);
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $order->update(['status' => 'failed']);
            \Log::info("Order {$order->id} marked as failed due to: {$transactionStatus}");
        } else if ($transactionStatus == 'pending') {
            $order->update(['status' => 'pending']);
            \Log::info("Order {$order->id} marked as pending");
        }

        return response()->json(['status' => 'success']);
    }

   
    private function addBooksToLibrary(Order $order)
    {
        $user = $order->user;
        
        \Log::info("Adding books to library for user: {$user->id}, order: {$order->id}");
        
        foreach ($order->orderItems as $item) {
            \Log::info("Processing book: {$item->book_id} for user: {$user->id}");
            
            // Add book to user's library using the relationship
            if (!$user->hasBookInLibrary($item->book_id)) {
                $user->libraryBooks()->attach($item->book_id);
                \Log::info("Book {$item->book_id} added to library for user {$user->id}");
            } else {
                \Log::info("Book {$item->book_id} already in library for user {$user->id}");
            }

            // Increment sales count
            $item->book->increment('sales_count');
            \Log::info("Sales count incremented for book {$item->book_id}");
        }

        // Remove only the purchased items from cart
        $cart = $user->cart;
        if ($cart) {
            $purchasedBookIds = $order->orderItems->pluck('book_id')->toArray();
            $cart->cartItems()->whereIn('book_id', $purchasedBookIds)->delete();
            \Log::info("Removed purchased items from cart for user {$user->id}");
        }
        
        \Log::info("Finished adding books to library for user: {$user->id}");
    }
}