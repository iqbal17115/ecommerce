<?php

namespace App\Models\Backend\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    use HasFactory;
    public function Product()
    {
        return $this->hasMany(Product::class)->take(10);
    }
}
