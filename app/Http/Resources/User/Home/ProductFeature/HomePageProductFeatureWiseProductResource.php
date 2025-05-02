<?php

namespace App\Http\Resources\User\Home\ProductFeature;

use Illuminate\Http\Resources\Json\JsonResource;

class HomePageProductFeatureWiseProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $priceDetails = $this->getPriceDetails();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'seller_sku' => $this->seller_sku,
            'stock_qty' => $this->stock_qty,
            'your_price' => $priceDetails['your_price'],
            'sale_price' => $priceDetails['sale_price'],
            'is_on_sale' => $priceDetails['is_on_sale'],
            'offer_percentage' => $priceDetails['offer_percentage'],
            'currency' => $priceDetails['currency'],
            'rating' => $this->reviews()->sum('rating') ?? 0,
            'image_path' => $this->getImagePath(),
            'has_variation' => count($this->productVariations) ? true : false
        ];
    }

    /**
     * Calculate and retrieve product price details.
     *
     * @return array
     */
    protected function getPriceDetails()
    {
        $isOnSale = $this->sale_price &&
            $this->sale_start_date &&
            $this->sale_end_date &&
            $this->sale_start_date <= now() &&
            $this->sale_end_date >= now();

            $offerPercentage = null;

        if ($isOnSale) {
            $offerPercentage = round((($this->your_price - $this->sale_price) / $this->your_price) * 100, 0);
        }

        return [
            'is_on_sale' => $isOnSale,
            'your_price' => number_format($this->your_price, 2),
            'sale_price' => $isOnSale ? number_format($this->sale_price, 2) : null,
            'offer_percentage' => $offerPercentage,
            'currency' => '৳', // Default to a fallback symbol
        ];
    }

    /**
     * Generate the image path for the product's main image.
     *
     * @return string|null
     */
    protected function getImagePath()
    {
        if ($this->ProductMainImage && $this->ProductMainImage->image) {
            return asset('storage/product_photo/' . $this->ProductMainImage->image);
        }

        return null; // Return null if no image is available
    }
}
