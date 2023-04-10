<?php

namespace App\Models\Backend\Product;

use App\Models\Backend\WebSetting\Advertisement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    use HasFactory;
    public function Advertisement()
    {
        return $this->hasMany(Advertisement::class);
    }
    public function Product()
    {
        return $this->hasMany(Product::class)->take(20);
    }
}
