<?php

namespace App\Models;

use App\Models\Patron;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubscriptionType extends Model
{
    protected $fillable = [
        'name',
        'price',
    ];

    public function patrons(): HasMany
    {
        return $this->hasMany(Patron::class);
    }
}
