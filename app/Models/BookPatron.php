<?php

namespace App\Models;

use App\Models\Patron;
use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookPatron extends Model
{
    protected $table = 'book_patron';

    protected $fillable = [
        'id',
        'book_id',
        'patron_id',
        'book_code'
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function patron(): BelongsTo
    {
        return $this->belongsTo(Patron::class);
    }
}
