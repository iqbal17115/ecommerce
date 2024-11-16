<?php

namespace App\Models\Backend\Inventory;
use App\Models\Backend\ProductInfo\Product;
use App\Models\Backend\Inventory\PurchaseInvoice;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PurchaseInvoiceDetail extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;
    protected $dates = ['deleted_at'];

    public function Product(){
        return $this->belongsTo(Product::class);
    }
    public function PurchaseInvoice(){
        return $this->belongsTo(PurchaseInvoice::class);
    }
}
