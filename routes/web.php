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
        
        // Reviews Management
        Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
        Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');
        
        // Profile Management
        Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');
    });
});