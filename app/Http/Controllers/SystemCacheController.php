<?php

namespace App\Http\Controllers;

use App\Services\HomeCacheService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;

class SystemCacheController extends Controller
{
    public function clear(): JsonResponse
    {
        try {
            // Clear Laravel caches
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');

            // Warm home cache
            app(HomeCacheService::class)->warmHomeCache();

            return response()->json([
                'success' => true,
                'message' => 'Cache cleared and warmed successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
