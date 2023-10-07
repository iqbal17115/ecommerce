<?php

namespace App\Models\Backend\Inventory;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Inventory\StockManager;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Invoice extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;
    protected $dates = ['deleted_at'];
    
    public function StockManager(){
        return $this->hasMany(StockManager::class);
    }

    public function ContactName(){
        return $this->hasOne(Contact::class);
    }


}
