<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'label', 'type'];

    /**
     * Get all settings as a cached array (single DB query, cached 10 min).
     */
    public static function getAllCached(): array
    {
        return Cache::remember('site_settings', 600, function () {
            return static::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Get a setting value by key (uses cached data).
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $all = static::getAllCached();
        return $all[$key] ?? $default;
    }

    /**
     * Set a setting value by key and clear cache.
     */
    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('site_settings');
    }
}
