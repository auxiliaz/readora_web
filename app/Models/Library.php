<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    protected $table = 'library';

    protected $fillable = [
        'user_id',
        'book_id',
    ];

    /**
     * Get the user that owns the library entry.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the book that owns the library entry.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
