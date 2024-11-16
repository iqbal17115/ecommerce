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
        static::saved(function (Sale $sale) {
            // Reload the saleDetails relationship after saving
            $sale->load('saleDetails');

            // Access the associated SaleDetails
            $saleDetails = $sale->saleDetails;
            // Iterate through each SaleDetail
            foreach ($saleDetails as $saleDetail) {
                $quantity = $saleDetail->quantity;

                if ($sale->status == 'processing') {
                    $sale->updateProductStock($saleDetail->product, -$quantity);
                } elseif ($sale->status == 'cancelled') {
                    $sale->updateProductStock($saleDetail->product, $quantity);
                }
            }
        });
    }

    public function updateProductStock($product, $quantity)
    {
        $product->stock_qty += $quantity;
        $product->save();
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
