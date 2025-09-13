<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    /**
     * Store a new review for a book.
     */
    public function store(ReviewRequest $request, $bookId)
    {
        try {
            // Check if user owns this book
            $book = Auth::user()->libraryBooks()
                ->where('book_id', $bookId)
                ->first();
                
            if (!$book) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only review books you have purchased.'
                ], 403);
            }
            
            // Check if user already has a review for this book
            $existingReview = Review::where('user_id', Auth::id())
                ->where('book_id', $bookId)
                ->first();
                
            if ($existingReview) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have already reviewed this book.'
                ], 400);
            }
            
            $review = Review::create([
                'user_id' => Auth::id(),
                'book_id' => $bookId,
                'rating' => $request->rating,
                'review' => $request->review,
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Review submitted successfully!',
                'review' => $review->load('user')
            ]);
        } catch (\Exception $e) {
            \Log::error('Review creation failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit review. Please try again.'
            ], 500);
        }
    }
    
    /**
     * Update an existing review.
     */
    public function update(ReviewRequest $request, $bookId, $reviewId)
    {
        try {
            // Check if user owns this book
            $book = Auth::user()->libraryBooks()
                ->where('books.id', $bookId)
                ->first();
                
            if (!$book) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only review books you have purchased.'
                ], 403);
            }
            
            // Check if user owns this review
            $review = Auth::user()->reviews()
                ->where('book_id', $bookId)
                ->where('id', $reviewId)
                ->first();
                
            if (!$review) {
                return response()->json([
                    'success' => false,
                    'message' => 'Review not found.'
                ], 404);
            }
            
            $review->update([
                'rating' => $request->rating,
                'review_text' => $request->review,
            ]);
            
            // Load the review with user relationship
            $review->load('user');
            
            return response()->json([
                'success' => true,
                'review' => $review,
                'message' => 'Review updated successfully!'
            ]);
        } catch (\Exception $e) {
            \Log::error('Review update failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update review. Please try again.'
            ], 500);
        }
    }
    
    /**
     * Delete a review.
     */
    public function destroy($bookId, $reviewId)
    {
        try {
            // Check if user owns this book
            $book = Auth::user()->libraryBooks()
                ->where('books.id', $bookId)
                ->first();
                
            if (!$book) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only delete reviews for books you have purchased.'
                ], 403);
            }
            
            // Check if user owns this review
            $review = Auth::user()->reviews()
                ->where('book_id', $bookId)
                ->where('id', $reviewId)
                ->first();
                
            if (!$review) {
                return response()->json([
                    'success' => false,
                    'message' => 'Review not found.'
                ], 404);
            }
            
            $review->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Review deleted successfully!'
            ]);
        } catch (\Exception $e) {
            \Log::error('Review deletion failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete review. Please try again.'
            ], 500);
        }
    }
    
    /**
     * Get reviews for a book.
     */
    public function getReviews($bookId)
    {
        $book = Book::findOrFail($bookId);
        
        $reviews = $book->reviews()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return response()->json([
            'success' => true,
            'reviews' => $reviews,
            'average_rating' => $book->average_rating,
            'total_reviews' => $book->reviews_count
        ]);
    }
    
    /**
     * Get user's review for a book.
     */
    public function getUserReview($bookId)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }
        
        $review = Auth::user()->reviews()
            ->where('book_id', $bookId)
            ->with('user')
            ->first();
        
        return response()->json([
            'success' => true,
            'review' => $review,
            'can_review' => Auth::user()->hasBookInLibrary($bookId)
        ]);
    }
}
