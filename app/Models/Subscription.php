<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'start_date',
        'end_date',
        'status',
        'custom_price',
        'discount_reason',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'custom_price' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Dynamic billing: use custom_price if set, otherwise fall back to package price.
     * This is the core BTRC-compliant billing logic from the master plan.
     */
    public function getPayableAmountAttribute(): float
    {
        return $this->custom_price !== null
            ? (float) $this->custom_price
            : (float) $this->package->price;
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->end_date->isFuture();
    }
}
