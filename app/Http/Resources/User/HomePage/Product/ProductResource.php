<?php

namespace App\Http\Resources\User\HomePage\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $defaultCombination = $this->productCombinations()->orderBy('price')->first();

        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'slug'     => $this->slug ?? null,
            'brand'    => $this->brand->name ?? null,
            'category' => $this->category->name ?? null,
            'image' => $this->media?->first()
                ? Storage::url($this->media->first()->path)
                : asset('images/no-image.png'),
            'price'         => $defaultCombination->price ?? 0,
            'special_price' => $defaultCombination->special_price ?? null,
            'discount'      => $this->calculateDiscount($defaultCombination),
            'rating' => (float) ($this->rating_avg ?? 0),
            'sold'   => (int) ($this->total_sold ?? 0),
            'combinations' => $this->whenLoaded('productCombinations', function () {
                return $this->productCombinations->map(function ($comb) {
                    return [
                        'id' => $comb->id,
                        'price' => $comb->price,
                        'special_price' => $comb->special_price,
                        'stock' => $comb->stock,
                    ];
                });
            }),
        ];
    }

    private function calculateDiscount($comb)
    {
        if (!$comb || !$comb->special_price) return 0;

        return round((($comb->price - $comb->special_price) / $comb->price) * 100);
    }
}
