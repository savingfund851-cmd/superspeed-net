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

    protected static function booted()
    {
        static::updated(function (ConnectionRequest $request) {
            if ($request->isDirty('status') && $request->status === 'completed') {
                // Auto create user if they don't already exist
                User::firstOrCreate(
                    ['login_id' => $request->mobile],
                    [
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->mobile,
                        'password' => \Illuminate\Support\Facades\Hash::make($request->mobile),
                        'address' => $request->address,
                        'role' => 'customer',
                        'status' => 'active',
                    ]
                );
            }
        });
    }
}
