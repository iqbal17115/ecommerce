<?php

namespace App\Models\Backend\Inventory;
use App\Models\Backend\ProductInfo\Product;
use App\Models\Backend\Inventory\SaleInvoice;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SaleInvoiceDetail extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;
    protected $dates = ['deleted_at'];

    public function Product(){
        return $this->belongsTo(Product::class);
    }
    public function SaleInvoice(){
        return $this->belongsTo(SaleInvoice::class);
    }
}
