<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlist';

    protected $fillable = [
        'user_id',
        'book_id',
    ];

    /**
     * Get the user that owns the wishlist entry.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the book that owns the wishlist entry.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
