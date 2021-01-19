<?php

namespace App\Models;

use App\Models\BookPatron;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'title',
        'synopsis',
        'author',
        'genre',
        'logo_path',
        'no_of_issues'
    ];

    public function bookPatrons(): HasMany
    {
        return $this->hasMany(BookPatron::class);
    }
}
