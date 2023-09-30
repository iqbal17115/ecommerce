<?php

namespace App\Models\Address;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'country_id',
        'name',
        'status'
    ];

    protected $sortable = [
        'name'
    ];

    protected $searchable = [
        'name'
    ];

    public function Country()
    {
        return $this->belongsTo(Country::class);
    }
}
