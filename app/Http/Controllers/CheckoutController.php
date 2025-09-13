<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Show the checkout page.
     */
    public function index()
    {
        $cart = Auth::user()->cart()->with('cartItems.book')->first();
        
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        
        return view('checkout.index', compact('cart'));
    }

    /**
     * Process the checkout and create Midtrans transaction.
     */
    public function process(Request $request)
    {
        $cart = Auth::user()->cart()->with('cartItems.book')->first();
        
        if (!$cart || $cart->cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty.'
            ], 400);
        }

        try {
            DB::beginTransaction();

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $cart->total_amount,
                'status' => 'pending',
                'midtrans_order_id' => 'ORDER-' . time() . '-' . Auth::id()
            ]);

            // Create order items
            foreach ($cart->cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $item->book_id,
                    'price' => $item->book->price
                ]);
            }

            // Prepare Midtrans transaction
            $transactionDetails = [
                'order_id' => $order->midtrans_order_id,
                'gross_amount' => (int) $cart->total_amount
            ];

            $itemDetails = [];
            foreach ($cart->cartItems as $item) {
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

            $midtransParams = [
                'transaction_details' => $transactionDetails,
                'item_details' => $itemDetails,
                'customer_details' => $customerDetails,
                'enabled_payments' => ['credit_card', 'bca_va', 'bni_va', 'bri_va', 'echannel', 'permata_va', 'other_va', 'gopay', 'shopeepay'],
                'vtweb' => []
            ];

            // For demo purposes, we'll simulate Midtrans response
            // In production, you would use actual Midtrans SDK
            $snapToken = 'demo_snap_token_' . time();
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

    /**
     * Handle successful payment.
     */
    public function success(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Update order status
        $order->update(['status' => 'success']);

        // Add books to user's library
        foreach ($order->orderItems as $item) {
            Library::firstOrCreate([
                'user_id' => Auth::id(),
                'book_id' => $item->book_id
            ]);

            // Update book sales count
            $item->book->increment('sales_count');
        }

        // Clear cart
        $cart = Auth::user()->cart;
        if ($cart) {
            $cart->cartItems()->delete();
        }

        return view('checkout.success', compact('order'));
    }

    /**
     * Handle failed payment.
     */
    public function failed(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->update(['status' => 'failed']);

        return view('checkout.failed', compact('order'));
    }

    /**
     * Handle Midtrans notification (webhook).
     */
    public function notification(Request $request)
    {
        // This would handle Midtrans webhook notifications
        // For demo purposes, we'll just return success
        
        $orderId = $request->order_id;
        $transactionStatus = $request->transaction_status;
        $fraudStatus = $request->fraud_status ?? null;

        $order = Order::where('midtrans_order_id', $orderId)->first();

        if (!$order) {
            return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
        }

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $order->update(['status' => 'pending']);
            } else if ($fraudStatus == 'accept') {
                $order->update(['status' => 'success']);
            }
        } else if ($transactionStatus == 'settlement') {
            $order->update(['status' => 'success']);
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $order->update(['status' => 'failed']);
        } else if ($transactionStatus == 'pending') {
            $order->update(['status' => 'pending']);
        }

        return response()->json(['status' => 'success']);
    }
}
