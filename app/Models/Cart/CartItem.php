<?php

namespace App\Models\Cart;

use App\Models\Backend\Product\Product;
use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory, BaseModel;
    protected $fillable = ['user_id', 'product_id', 'quantity', 'is_active'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
