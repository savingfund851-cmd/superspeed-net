<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    protected $fillable = [
        'name',
        'speed_mbps',
        'price',
        'validity_days',
        'is_active',
        'btrc_approved_tariff',
        'btrc_approval_number',
        'description',
        'features',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'btrc_approved_tariff' => 'decimal:2',
        'features' => 'array',
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function getSpeedLabelAttribute(): string
    {
        return $this->speed_mbps >= 1000
            ? ($this->speed_mbps / 1000) . ' Gbps'
            : $this->speed_mbps . ' Mbps';
    }
}
