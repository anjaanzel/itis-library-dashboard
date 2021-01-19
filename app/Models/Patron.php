<?php

namespace App\Models;

use App\Models\BookPatron;
use App\Models\SubscriptionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patron extends Model
{
    protected $fillable = [
        'id',
        'full_name',
        'phone_number',
        'date_of_birth',
        'expected_renew_date',
        'subscription_type_id'
    ];

    public function bookPatrons(): HasMany
    {
        return $this->hasMany(BookPatron::class);
    }

    public function subscriptionType(): BelongsTo
    {
        return $this->belongsTo(SubscriptionType::class);
    }
}
