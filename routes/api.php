<?php

use App\Http\Controllers\Api\PackageController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/packages', [PackageController::class, 'index']);
    Route::get('/packages/{package}', [PackageController::class, 'show']);
});

// Public alias without version prefix (used by landing page)
Route::get('/packages', function () {
    return Cache::remember('api_packages', 300, function () {
        return \App\Models\Package::where('is_active', true)
            ->orderBy('price', 'asc')
            ->get(['id', 'name', 'speed_mbps', 'price', 'validity_days',
                   'btrc_approved_tariff', 'btrc_approval_number',
                   'description', 'features'])->toArray();
    });
});

Route::get('/menus', function () {
    return Cache::remember('api_menus', 300, function () {
        return \App\Models\Menu::with('children')
            ->whereNull('parent_id')
            ->orderBy('order')
            ->get()->toArray();
    });
});

Route::post('/payment/ipn', [\App\Http\Controllers\PaymentController::class, 'ipn']);
