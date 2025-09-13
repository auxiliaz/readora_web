<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\PasswordUpdateRequest;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get user statistics
        $stats = [
            'total_orders' => $user->orders()->count(),
            'total_spent' => $user->orders()->where('status', 'completed')->sum('total_amount'),
            'books_owned' => $user->libraryBooks()->count(),
            'wishlist_count' => $user->wishlistBooks()->count(),
            'reviews_written' => $user->reviews()->count(),
        ];
        
        // Get recent orders
        $recentOrders = $user->orders()
            ->with(['orderItems.book'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Get recent reviews
        $recentReviews = $user->reviews()
            ->with('book')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        
        return view('profile.index', compact('user', 'stats', 'recentOrders', 'recentReviews'));
    }
    
    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }
    
    /**
     * Update the user's profile.
     */
    public function update(ProfileUpdateRequest $request)
    {
        try {
            $user = Auth::user();
            $user->update($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully!'
            ]);
        } catch (\Exception $e) {
            \Log::error('Profile update failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile. Please try again.'
            ], 500);
        }
    }
    
    /**
     * Update the user's password.
     */
    public function updatePassword(PasswordUpdateRequest $request)
    {
        try {
            $user = Auth::user();
            
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Current password is incorrect.'
                ], 400);
            }
            
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully!'
            ]);
        } catch (\Exception $e) {
            \Log::error('Password update failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update password. Please try again.'
            ], 500);
        }
    }
    
    /**
     * Show transaction history.
     */
    public function transactions()
    {
        $orders = Auth::user()->orders()
            ->with(['orderItems.book'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('profile.transactions', compact('orders'));
    }
    
    /**
     * Show order details.
     */
    public function showOrder($orderId)
    {
        $order = Auth::user()->orders()
            ->with(['orderItems.book'])
            ->findOrFail($orderId);
        
        return view('profile.order-details', compact('order'));
    }
}
