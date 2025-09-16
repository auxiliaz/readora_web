<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];

    /**
     * Get the books for the publisher.
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    /**
     * Get the books count attribute.
     */
    public function getJumlahBukuAttribute()
    {
        return $this->books()->count();
    }
}
