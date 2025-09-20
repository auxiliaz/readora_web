<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'isbn',
        'description',
        'price',
        'category_id',
        'author_id',
        'publisher_id',
        'file_path',
        'cover_image',
        'sales_count',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Get the category that owns the book.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the author that owns the book.
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the publisher that owns the book.
     */
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    /**
     * Get the cart items for the book.
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Get the order items for the book.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the users who have this book in their library.
     */
    public function libraryUsers()
    {
        return $this->belongsToMany(User::class, 'library')->withTimestamps();
    }

    /**
     * Get the users who have this book in their wishlist.
     */
    public function wishlistUsers()
    {
        return $this->belongsToMany(User::class, 'wishlist')->withTimestamps();
    }

    /**
     * Get the reviews for the book.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the notes for the book.
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Get the average rating for the book.
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating');
    }

    /**
     * Get the total reviews count for the book.
     */
    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }
}
