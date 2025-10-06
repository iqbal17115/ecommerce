<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\FacebookCatalogExportService;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function export(FacebookCatalogExportService $exporter)
    {
        $path = 'catalog/facebook_catalog.csv';
        $fullPath = storage_path("app/public/{$path}");

        // Generate CSV
        $exporter->export($path);

        // Return JSON with file URL
        return response()->json([
            'success' => true,
            'url' => asset('storage/' . $path) // public/storage/catalog/facebook_catalog.csv
        ]);
    }
}
