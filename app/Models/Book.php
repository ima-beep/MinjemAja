<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // ⛔ JANGAN set $table ke 'buku'
    // Laravel otomatis pakai 'books'

    protected $fillable = [
        'name',
        'publication_date',
        'description',
        'cover_image',
        'book_type',
        'publisher_id',
        'author_id',
        'category_id',
        'stok',
    ];

    protected $casts = [
        'publication_date' => 'date',
    ];

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
