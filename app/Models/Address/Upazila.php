<?php

namespace App\Models\Address;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upazila extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'district_id',
        'name',
        'status'
    ];

    protected $sortable = [
        'name'
    ];

    protected $searchable = [
        'name'
    ];

    public function District()
    {
        return $this->belongsTo(District::class);
    }
}
