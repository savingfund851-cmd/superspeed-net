<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\JsonResponse;

class PackageController extends Controller
{
    public function index(): JsonResponse
    {
        $packages = Package::where('is_active', true)
            ->orderBy('price', 'asc')
            ->get(['id', 'name', 'speed_mbps', 'price', 'validity_days',
                   'btrc_approved_tariff', 'btrc_approval_number',
                   'description', 'features']);

        return response()->json($packages);
    }

    public function show(Package $package): JsonResponse
    {
        return response()->json($package);
    }
}
