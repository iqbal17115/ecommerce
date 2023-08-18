<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\District;
use App\Models\FrontEnd\OrderDetail;
use App\Models\Backend\Inventory\SaleInvoice;
use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory, SoftDeletes, BaseModel;
    protected $dates = ['deleted_at'];

    protected $searchable = [
        'code',
        'order_date'
    ];

    protected $sortable = [
        'order_date'
    ];

    public function SaleInvoice()
    {
        return $this->hasOne(SaleInvoice::class);
    }
    public function Contact()
    {
        return $this->belongsTo(Contact::class);
    }
    public function District()
    {
        return $this->belongsTo(District::class);
    }
    public function OrderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
