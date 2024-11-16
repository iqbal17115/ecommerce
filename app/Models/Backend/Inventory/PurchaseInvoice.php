<?php

namespace App\Models\Backend\Inventory;

use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Setting\Branch;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseInvoice extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;
    protected $dates = ['deleted_at'];

    public function ContactName()
    {
        return $this->hasOne(Contact::class);
    }

    public function Contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function PurchaseInvoiceDetail()
    {
        return $this->hasMany(purchaseInvoiceDetail::class);
    }

    public function PurchasePayment()
    {
        return $this->hasMany(PurchasePayment::class);
    }

    public function Branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
