<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    /**
     * Get all active menus with their children, ordered by 'order' column.
     */
    public function index(): JsonResponse
    {
        $menus = Menu::whereNull('parent_id')
            ->where('is_active', 1)
            ->with(['children' => function ($query) {
                $query->where('is_active', 1)->orderBy('order');
            }])
            ->orderBy('order')
            ->get();

        return response()->json($menus)->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }
}
