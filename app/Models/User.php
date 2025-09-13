<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the cart for the user.
     */
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * Get the orders for the user.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the books in the user's library.
     */
    public function libraryBooks()
    {
        return $this->belongsToMany(Book::class, 'library')->withTimestamps();
    }

    /**
     * Get the books in the user's wishlist.
     */
    public function wishlistBooks()
    {
        return $this->belongsToMany(Book::class, 'wishlist')->withTimestamps();
    }

    /**
     * Get the reviews for the user.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the notes for the user.
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Check if user has a book in their library.
     */
    public function hasBookInLibrary($bookId)
    {
        return $this->libraryBooks()->where('book_id', $bookId)->exists();
    }

    /**
     * Check if user has a book in their wishlist.
     */
    public function hasBookInWishlist($bookId)
    {
        return $this->wishlistBooks()->where('book_id', $bookId)->exists();
    }

    /**
     * Get or create cart for the user.
     */
    public function getOrCreateCart()
    {
        return $this->cart ?: $this->cart()->create();
    }
}
