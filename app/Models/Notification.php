<?php

namespace App\Models;

use App\Models\Backend\ContactInfo\Contact;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;
    public function Contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
