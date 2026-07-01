<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConnectionRequest extends Model
{
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'address',
        'package_id',
        'remarks',
        'status',
    ];

    /**
     * Get the package requested.
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
