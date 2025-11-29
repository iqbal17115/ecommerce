<?php

namespace App\Http\Controllers\Backend\Product;

use App\Helpers\Message;
use App\Models\Backend\Product\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\Product\StoreProductRequest;
use App\Http\Requests\AdminPanel\Product\UpdateProductRequest;
use App\Models\Product;
use App\Services\Admin\AdminProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct(private readonly AdminProductService $adminProductService) {}

    public function updateStockQty(Request $request)
    {
        $updatedProduct = Product::where('id', $request->id)
            ->update(['stock_qty' => $request->stock_qty]);

        $updatedProduct = Product::find($request->id);
        return Message::success(__("messages.success_add"), $updatedProduct);
    }


    public function getCategory($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    public function index(Request $request)
    {
        $products = $this->adminProductService->getProductList($request);

        return view('backend.product-list.index', compact('products'));
    }

    public function create()
    {
        return view('backend.products.index', [
            'product' => null
        ]);
    }

    public function edit(Request $request)
    {
        $product = Product::with(
            [
                'category',
                'brand',
                'media',
                'gallery',
                'productVariants',
                'productVariants.variantOptions',
                'productVariants.variantOptions.productVariant',
                'productCombinations',
                'productCombinations.combinationOptionPivots',
                'productCombinations.combinationOptionPivots.productCombination'
            ]
        )->findOrFail($request->id);

        $editProduct = [
            'id' => $product->id,
            'name' => $product->name,
            'category_id' => $product->category_id,
            'category_name' => $product->category->name,
            'brand_id' => $product->brand_id,
            'brand_name' => $product->brand->name,
            'medias' => $product->gallery->map(function ($media) {
                return [
                    'id' => $media->id,
                    'url' => Storage::url($media->path), // <- gives /storage/products/filename.png
                    'media_type' => $media->media_type,
                ];
            }),
            'promo_image' => $product->promoImage()
                ? Storage::url($product->promoImage()->path)
                : null,
            'description' => $product->description,
            'short_description' => $product->short_description,
            'highlights' => $product->highlights,
            'variants' => $product->productVariants->map(function ($variant) {
                return [
                    'id' => $variant->id,
                    'name' => $variant->name,
                    'is_image_variant' => $variant->is_image_variant,
                    'options' => $variant->variantOptions->map(function ($option) {
                        return [
                            'id' => $option->id,
                            'value' => $option->option_value
                        ];
                    })->toArray(),
                ];
            })->toArray(),
            'combinations' => $product->productCombinations->map(function ($combo) {
                return [
                    'id' => $combo->id,
                    'price' => $combo->price,
                    'special_price' => $combo->special_price,
                    'stock' => $combo->stock,
                    'seller_sku' => $combo->seller_sku,
                    'option_values' => $combo->combinationOptionPivots->map(fn($pivot) => $pivot->variantOption->option_value)->toArray(),
                ];
            })->toArray(),
            'product_specs' => $product->productSpecs->map(function ($spec) {
                return [
                    'id' => $spec->id,
                    'attribute_name' => $spec->attribute_name,
                    'value' => $spec->value,
                ];
            })->toArray(),
        ];

        return view('backend.products.index', compact('product', 'editProduct'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $updatedProduct = $this->adminProductService->updateProduct($product, $request->validated());

        return Message::success(__("messages.success_update"), $updatedProduct);
    }

    /**
     * Handles the product creation form submission (POST /api/products).
     * * @param StoreProductRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        // Delegate complex business logic to the Service Layer
        $product = $this->adminProductService->storeProduct($request->validated());

        // Redirect to a success page or the product edit view
        return Message::success(__("messages.success_add"), $product);
    }
}
