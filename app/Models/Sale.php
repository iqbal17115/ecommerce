<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'status',
        'invoice_no',
        'order_id',
        'user_id',
        'date',
        'total_amount',
        'discount',
        'shipping_charge',
        'vat',
        'payable_amount',
        'note',
        'invoice_channel',
        'coupon_code_id'
    ];

    protected static function booted()
    {
        static::saved(function ($sale) {
            if ($sale->status == 'pending') {
                $sale->updateProductStock(-$sale->saleDetails->quantity);
            } elseif ($sale->status == 'cancelled') {
                $sale->updateProductStock($sale->saleDetails->quantity);
            }
        });
    }

    public function updateProductStock($quantity)
    {
        foreach ($this->saleDetails as $saleDetail) {
            $product = $saleDetail->product;
            $product->stock_qty += $quantity;
            $product->save();
        }
    }

    public function saleDetail()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
