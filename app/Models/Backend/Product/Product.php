<?php

namespace App\Models\Backend\Product;

use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\Brand;
use App\Models\Backend\Product\ProductDetail;
use App\Models\Backend\Product\ProductMoreDetail;
use App\Models\Backend\Product\ProductKeyword;
use App\Models\Backend\Product\ProductCompliance;
use App\Models\Backend\Product\ProductImage;
use App\Models\Cart\CartItem;
use App\Models\FrontEnd\Review;
use App\Models\ProductColor;
use App\Models\ProductVariation;
use App\Models\User;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;

    protected $table = 'products';

    protected $fillable = [
        'code',
        'name',
        'type',
        'seller_sku',
        'purchase_price',
        'opening_qty',
        'quantity_unit',
        'your_price',
        'sale_price',
        'retail_price',
        'max_order_qty',
        'model_number',
        'model_name',
        'sale_start_date',
        'sale_end_date',
        'booking_date',
        'start_selling_date',
        'offering_gift_message',
        'gift_wrap_available',
        'brand_available',
        'varition_type_data',
        'variation',
        'shipping_class_id',
        'region_publication_id',
        'category_id',
        'brand_id',
        'product_feature_id',
        'branch_id',
        'status',
        'vendor_id',
        'is_active',
    ];

    protected array $searchable = [
        'code',
        'name',
        'type',
        'code',
        'brand.name',
        'Category.name',
        'productFeature.name',
        'purchase_price',
        'your_price',
        'sale_price',
        'retail_price',
        'model_number',
        'model_name',
    ];

    protected array $filterable = [
        'brand_names' => 'filterByBrands',
        'category_names' => 'filterByCategories',
        'color_names' => 'filterByColorValues',
        'size_names' => 'filterBySizeValues',
        'feature_names' => 'filterByFeatureNames',
    ];

    protected array $sortable = [
        'name' => 'name',
        'your_price' => 'your_price',
        'sale_price' => 'sale_price',
    ];

    protected $dates = ['deleted_at'];

    public function scopeFilterByPriceRange($query, $minPrice, $maxPrice, $currentDate)
    {
        return $query->where(function ($query) use ($minPrice, $maxPrice, $currentDate) {
            $query->where(function ($query) use ($minPrice, $maxPrice) {
                $query->where('your_price', '>=', $minPrice)
                    ->where('your_price', '<=', $maxPrice);
            })->orWhere(function ($query) use ($minPrice, $maxPrice, $currentDate) {
                $query->where('sale_price', '>=', $minPrice)
                    ->where('sale_price', '<=', $maxPrice)
                    ->where('sale_start_date', '<=', $currentDate)
                    ->where('sale_end_date', '>=', $currentDate);
            });
        });
    }

    public function cartItem(): HasOne
    {
        return $this->hasOne(CartItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function isFreeShippingEligible()
    {
        if ($this->free_shipping == 1) {
            return true;
        }

        return false;
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function ProductMainImage()
    {
        return $this->hasOne(ProductImage::class);
    }
    public function ProductImage()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function ProductCompliance()
    {
        return $this->hasOne(ProductCompliance::class);
    }
    public function ProductKeyword()
    {
        return $this->hasMany(ProductKeyword::class);
    }
    public function ProductMoreDetail()
    {
        return $this->hasOne(ProductMoreDetail::class);
    }
    public function ProductDetail()
    {
        return $this->hasOne(ProductDetail::class);
    }
    public function Brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productVariations(): HasMany
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function productColors(): HasMany
    {
        return $this->hasMany(ProductColor::class);
    }

    public function productFeature(): BelongsTo
    {
        return $this->belongsTo(ProductFeature::class, 'product_feature_id');
    }

    public function reviewSum()
    {
        return $this->hasOne(Review::class, 'product_id')
            ->selectRaw('product_id, SUM(rating) as sum_rating')
            ->groupBy('product_id');
    }

    public function filterByBrands($query, $value): mixed
    {
        return $query->whereHas('Brand', function ($query) use ($value) {
            $query->whereIn('name', explode(",", $value));
        });
    }

    public function filterByFeatureNames($query, $value): mixed
    {
        return $query->whereHas('productFeature', function ($query) use ($value) {
            $query->whereIn('name', explode(",", $value));
        });
    }

    public function filterByCategories($query, string $value): mixed
    {
        // Decode the URL-encoded category names
        $decodedValue = urldecode($value);

        // Convert the category names into an array
        $categoryNames = explode(",", $decodedValue);

        // Fetch all categories by names
        $categories = Category::whereIn('name', $categoryNames)->get();

        // Collect all category IDs including all descendants
        $categoryIds = [];

        // Loop through each category to get its ID and all child categories recursively
        foreach ($categories as $category) {
            // Add the parent category ID
            $categoryIds[] = $category->id;

            // Recursively collect child category IDs
            $this->collectChildCategoryIds($category, $categoryIds);
        }

        // Filter products by the collected category IDs
        return $query->whereHas('category', function ($query) use ($categoryIds) {
            $query->whereIn('id', $categoryIds);
        });
    }

    protected function collectChildCategoryIds(Category $category, array &$categoryIds): void
    {
        // Get all direct children of the current category
        $children = $category->subcategories; // Ensure this relationship is defined in the Category model

        foreach ($children as $child) {
            // Add the child category ID
            $categoryIds[] = $child->id;

            // Call the method recursively to collect IDs of children of the current child
            $this->collectChildCategoryIds($child, $categoryIds);
        }
    }

    public function filterByColorValues($query, string $value): mixed
    {
        return $query->whereHas('productVariations.productVariationAttributes.attributeValue', function ($query) use ($value) {
            $query->whereIn('value', explode(",", $value));
        });
    }

    public function filterBySizeValues($query, string $value): mixed
    {
        return $query->whereHas('productVariations.productVariationAttributes.attributeValue', function ($query) use ($value) {
            $query->whereIn('value', explode(",", $value));
        });
    }

    public function calculateProductPrice()
    {
        if ($this->isOnSale()) {
            return $this->sale_price;
        }

        return $this->your_price;
    }

    public function isOnSale()
    {
        $currentDate = now();

        return ($this->sale_price &&
            $this->sale_start_date &&
            $this->sale_end_date &&
            $this->sale_start_date <= $currentDate &&
            $this->sale_end_date >= $currentDate
        );
    }
}
