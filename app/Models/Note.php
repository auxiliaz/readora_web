<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'highlight_text',
        'note_text',
        'page_number',
    ];

    /**
     * Get the user that owns the note.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the book that owns the note.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Scope a query to only include notes for a specific page.
     */
    public function scopeForPage($query, $pageNumber)
    {
        return $query->where('page_number', $pageNumber);
    }

    /**
     * Scope a query to only include highlights.
     */
    public function scopeHighlights($query)
    {
        return $query->whereNotNull('highlight_text');
    }

    /**
     * Scope a query to only include notes with text.
     */
    public function scopeWithNotes($query)
    {
        return $query->whereNotNull('note_text');
    }
}
