<?php

namespace App\Models\Backend\ContactInfo;

use App\Models\Backend\Inventory\PurchaseInvoice;
use App\Models\Backend\Inventory\PurchasePayment;
use App\Models\Backend\Inventory\SaleInvoice;
use App\Models\Backend\Inventory\SalePayment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\FrontEnd\Order;
use App\Models\Backend\Transaction\Payment;
use App\Models\Ecommerce\Setting\District;
use App\Models\Ecommerce\Setting\Division;
use App\Models\Ecommerce\Setting\Union;
use App\Models\Ecommerce\Setting\Upazila;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function PurchaseInvoice(){
        return $this->hasMany(PurchaseInvoice::class);
    }
    public function PurchasePayment(){
        return $this->hasMany(PurchasePayment::class);
    }
    public function SaleInvoice(){
        return $this->hasMany(SaleInvoice::class);
    }
    public function SalePayment(){
        return $this->hasMany(SalePayment::class);
    }
    public function Order(){
        return $this->hasMany(Order::class);
    }
    public function PaymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }
    public function Payment(){
        return $this->hasMany(Payment::class);
    }
    public function Union(){
        return $this->belongsTo(Union::class);
    }
    public function Upazila(){
        return $this->belongsTo(Upazila::class, 'upazilla_id');
    }
    public function District(){
        return $this->belongsTo(District::class);
    }
    public function Division(){
        return $this->belongsTo(Division::class);
    }
}
