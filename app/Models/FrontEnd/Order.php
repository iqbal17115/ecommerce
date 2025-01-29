<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\District;
use App\Models\FrontEnd\OrderDetail;
use App\Models\Backend\Inventory\SaleInvoice;
use App\Models\Backend\Order\OrderTracking;
use App\Models\Backend\OrderProduct\OrderNoteStatus;
use App\Models\Backend\OrderProduct\OrderPayment;
use App\Models\Backend\OrderProduct\OrderProductBox;
use App\Models\OrderAddress;
use App\Models\User;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use App\Traits\GeneratesOrderCodeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;
    
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'code',
        'payment_method',
        'user_id',
        'order_date',
        'total_amount',
        'other_amount',
        'discount',
        'shipping_charge',
        'vat',
        'payable_amount',
        'note',
        'coupon_code_id',
        'status',
        'is_active'
    ];

    protected array $searchable = [
        'code',
        'order_date'
    ];

    protected $sortable = [
        'order_date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderAddress()
    {
        return $this->hasOne(OrderAddress::class);
    }

    public function orderTracking()
    {
        return $this->hasMany(OrderTracking::class);
    }

    public function orderProductBox()
    {
        return $this->hasMany(OrderProductBox::class);
    }

    public function orderPayment()
    {
        return $this->hasOne(OrderPayment::class);
    }

    public function orderNoteStatus()
    {
        return $this->hasOne(OrderNoteStatus::class);
    }

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
