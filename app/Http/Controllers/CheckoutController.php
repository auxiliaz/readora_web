<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart()->with('cartItems.book.category', 'cartItems.book.author', 'cartItems.book.publisher')->first();
        
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        
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

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $cart->total_amount,
                'status' => 'pending',
                'midtrans_order_id' => 'ORDER-' . time() . '-' . Auth::id()
            ]);

            foreach ($cart->cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $item->book_id,
                    'price' => $item->book->price
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

        if ($order->status === 'success') {
            $this->addBooksToLibrary($order);
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

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $order->update(['status' => 'pending']);
            } else if ($fraudStatus == 'accept') {
                $order->update(['status' => 'success']);
                $this->addBooksToLibrary($order);
            }
        } else if ($transactionStatus == 'settlement') {
            $order->update(['status' => 'success']);
            $this->addBooksToLibrary($order);
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $order->update(['status' => 'failed']);
        } else if ($transactionStatus == 'pending') {
            $order->update(['status' => 'pending']);
        }

        return response()->json(['status' => 'success']);
    }

   
    private function addBooksToLibrary(Order $order)
    {
        foreach ($order->orderItems as $item) {
            Library::firstOrCreate([
                'user_id' => $order->user_id,
                'book_id' => $item->book_id
            ]);

            $item->book->increment('sales_count');
        }

        
        $cart = $order->user->cart;
        if ($cart) {
            $cart->cartItems()->delete();
        }
    }
}