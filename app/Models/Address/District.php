<?php

namespace App\Models\Address;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory, SoftDeletes, BaseModel;

    protected $fillable = [
        'division_id',
        'name',
        'status'
    ];

    public function Division()
    {
        return $this->belongsTo(Division::class);
    }
}
