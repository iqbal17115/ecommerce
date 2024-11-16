<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'sale_id',
        'product_id',
        'unit_price',
        'quantity',
        'total_price'
    ];


    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
