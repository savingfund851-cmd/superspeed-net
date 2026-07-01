<?php

use App\Http\Controllers\Api\PackageController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/packages', [PackageController::class, 'index']);
    Route::get('/packages/{package}', [PackageController::class, 'show']);
});

// Public alias without version prefix (used by landing page)
Route::get('/packages', [PackageController::class, 'index']);
Route::get('/menus', function () {
    return App\Models\Menu::with('children')->whereNull('parent_id')->orderBy('order')->get();
});

Route::post('/payment/ipn', [\App\Http\Controllers\PaymentController::class, 'ipn'])->name('payment.ipn');
