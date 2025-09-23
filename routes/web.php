<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Book Routes
Route::get('/categories', [BookController::class, 'categories'])->name('categories');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Cart Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{item}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{item}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');
    Route::get('/cart/count', [App\Http\Controllers\CartController::class, 'count'])->name('cart.count');
    
    // Wishlist Routes
    Route::get('/wishlist', [App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add', [App\Http\Controllers\WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove', [App\Http\Controllers\WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/toggle', [App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::post('/wishlist/move-to-cart', [App\Http\Controllers\WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');
    Route::get('/wishlist/count', [App\Http\Controllers\WishlistController::class, 'count'])->name('wishlist.count');
    
    // Checkout Routes
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{order}', [App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/failed/{order}', [App\Http\Controllers\CheckoutController::class, 'failed'])->name('checkout.failed');
});

// Library Routes (authenticated)
Route::middleware('auth')->group(function () {
    Route::get('/library', [App\Http\Controllers\LibraryController::class, 'index'])->name('library.index');
    Route::get('/library/{book}', [App\Http\Controllers\LibraryController::class, 'show'])->name('library.show');
    
    // Reader Routes
    Route::get('/reader/{book}', [App\Http\Controllers\ReaderController::class, 'show'])->name('reader.show');
    Route::get('/reader/{book}/pdf', [App\Http\Controllers\ReaderController::class, 'servePdf'])->name('reader.pdf');
    
    Route::post('/reader/{book}/notes', [App\Http\Controllers\ReaderController::class, 'saveNote'])->name('reader.notes.save');
    Route::put('/reader/{book}/notes/{note}', [App\Http\Controllers\ReaderController::class, 'updateNote'])->name('reader.notes.update');
    Route::delete('/reader/{book}/notes/{note}', [App\Http\Controllers\ReaderController::class, 'deleteNote'])->name('reader.notes.delete');
    Route::get('/reader/{book}/notes', [App\Http\Controllers\ReaderController::class, 'getNotes'])->name('reader.notes.get');
});

// Profile Routes (authenticated)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/profile/transactions', [App\Http\Controllers\ProfileController::class, 'transactions'])->name('profile.transactions');
    Route::get('/profile/orders/{order}', [App\Http\Controllers\ProfileController::class, 'showOrder'])->name('profile.order');
});

// Search Routes
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search.index');
Route::get('/search/suggestions', [App\Http\Controllers\SearchController::class, 'suggestions'])->name('search.suggestions');

// Review Routes
Route::post('/books/{book}/reviews', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
Route::put('/books/{book}/reviews/{review}', [App\Http\Controllers\ReviewController::class, 'update'])->name('reviews.update');
Route::delete('/books/{book}/reviews/{review}', [App\Http\Controllers\ReviewController::class, 'destroy'])->name('reviews.destroy');
Route::get('/books/{book}/reviews', [App\Http\Controllers\ReviewController::class, 'getReviews'])->name('reviews.get');
Route::get('/books/{book}/user-review', [App\Http\Controllers\ReviewController::class, 'getUserReview'])->name('reviews.user');

// Midtrans Webhook (no auth required)
Route::post('/midtrans/notification', [App\Http\Controllers\CheckoutController::class, 'notification'])->name('midtrans.notification');

// Debug route (remove in production)
Route::get('/debug/test-cart-wishlist', [App\Http\Controllers\DebugController::class, 'testCartWishlist'])->name('debug.test');

// Test Midtrans config
Route::get('/debug/midtrans-config', function() {
    $serverKey = config('services.midtrans.server_key');
    $clientKey = config('services.midtrans.client_key');
    
    return response()->json([
        'server_key_status' => $serverKey ? 'SET' : 'NOT SET',
        'client_key_status' => $clientKey ? 'SET' : 'NOT SET',
        'server_key_length' => $serverKey ? strlen($serverKey) : 0,
        'client_key_length' => $clientKey ? strlen($clientKey) : 0,
        'server_key_preview' => $serverKey ? substr($serverKey, 0, 25) . '...' : 'NULL',
        'client_key_preview' => $clientKey ? substr($clientKey, 0, 25) . '...' : 'NULL',
        'server_key_format_ok' => $serverKey ? (strpos($serverKey, 'SB-Mid-server-') === 0) : false,
        'client_key_format_ok' => $clientKey ? (strpos($clientKey, 'SB-Mid-client-') === 0) : false,
        'is_production' => config('services.midtrans.is_production'),
        'env_direct' => [
            'server' => env('MIDTRANS_SERVER_KEY') ? substr(env('MIDTRANS_SERVER_KEY'), 0, 25) . '...' : 'NULL',
            'client' => env('MIDTRANS_CLIENT_KEY') ? substr(env('MIDTRANS_CLIENT_KEY'), 0, 25) . '...' : 'NULL',
        ]
    ]);
});

// Test Midtrans SDK
Route::get('/debug/test-midtrans-sdk', function() {
    // Also check raw .env content
    $envContent = file_get_contents(base_path('.env'));
    $midtransLines = [];
    foreach (explode("\n", $envContent) as $line) {
        if (strpos($line, 'MIDTRANS') !== false) {
            $midtransLines[] = $line;
        }
    }
    try {
        // Test basic Midtrans configuration
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $clientKey = env('MIDTRANS_CLIENT_KEY');
        
        // DETAILED DEBUG INFO - Check if keys are truncated
        if (!$serverKey || !$clientKey || strlen($serverKey) < 40 || strlen($clientKey) < 40) {
            return response()->json([
                'error' => 'API Keys issue detected',
                'server_key_exists' => !empty($serverKey),
                'client_key_exists' => !empty($clientKey),
                'server_key_length' => strlen($serverKey ?: ''),
                'client_key_length' => strlen($clientKey ?: ''),
                'server_key_preview' => $serverKey ? substr($serverKey, 0, 30) . '...' : 'NULL',
                'client_key_preview' => $clientKey ? substr($clientKey, 0, 30) . '...' : 'NULL',
                'diagnosis' => 'API KEYS ARE TOO SHORT OR MISSING! Expected 40+ chars each.',
                'solution' => 'Get FULL API keys from Midtrans dashboard and update .env file',
                'raw_env_lines' => $midtransLines, // Show what's actually in .env file
                'env_file_path' => base_path('.env')
            ]);
        }
        
        // Configure Midtrans
        \Midtrans\Config::$serverKey = $serverKey;
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        
        // Test simple transaction
        $params = [
            'transaction_details' => [
                'order_id' => 'TEST-' . time(),
                'gross_amount' => 10000
            ],
            'customer_details' => [
                'first_name' => 'Test',
                'email' => 'test@example.com'
            ]
        ];
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        
        return response()->json([
            'success' => true,
            'message' => 'Midtrans SDK working!',
            'snap_token' => substr($snapToken, 0, 20) . '...',
            'server_key_length' => strlen($serverKey),
            'client_key_length' => strlen($clientKey)
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => true,
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    }
});

// Advanced Midtrans Debug
Route::get('/debug/midtrans-advanced', function() {
    try {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $clientKey = env('MIDTRANS_CLIENT_KEY');
        
        // Test 1: Basic info
        $info = [
            'server_key_length' => strlen($serverKey ?: ''),
            'client_key_length' => strlen($clientKey ?: ''),
            'server_key_preview' => $serverKey ? substr($serverKey, 0, 30) . '...' : 'NULL',
            'client_key_preview' => $clientKey ? substr($clientKey, 0, 30) . '...' : 'NULL',
        ];
        
        // Test 2: Try simple curl to Midtrans
        $url = 'https://app.sandbox.midtrans.com/snap/v1/transactions';
        $data = [
            'transaction_details' => [
                'order_id' => 'TEST-' . time(),
                'gross_amount' => 10000
            ]
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode($serverKey . ':')
            ],
            CURLOPT_TIMEOUT => 30
        ]);
        
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curlError = curl_error($curl);
        curl_close($curl);
        
        return response()->json([
            'basic_info' => $info,
            'curl_test' => [
                'http_code' => $httpCode,
                'curl_error' => $curlError ?: 'No curl error',
                'response' => $response ? json_decode($response, true) : 'No response',
                'url_used' => $url
            ],
            'diagnosis' => $httpCode === 401 ? 'API Keys Invalid or Account Issue' : 
                         ($httpCode === 200 ? 'Keys Working!' : 'Other HTTP Error'),
            'next_steps' => $httpCode === 401 ? 
                'Check: 1) Account verification, 2) Keys from correct environment, 3) Account status' :
                'Keys seem to work, check Laravel Midtrans SDK usage'
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    }
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Authentication Routes (no middleware)
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    
    // Protected Admin Routes
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        // Books Management
        Route::resource('books', AdminBookController::class);
        
        // Categories Management
        Route::resource('categories', AdminCategoryController::class);
        
        // Authors Management
        Route::resource('authors', App\Http\Controllers\Admin\AuthorController::class);
        
        // Publishers Management
        Route::resource('publishers', App\Http\Controllers\Admin\PublisherController::class);
        
        // Reviews Management
        Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
        Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');
        
        // Profile Management
        Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');
    });
});