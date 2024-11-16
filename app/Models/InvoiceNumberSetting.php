<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceNumberSetting extends Model
{
    use HasFactory, BaseModel, SoftDeletes, DisplayNameTrait;

    protected $table = 'invoice_number_settings';

    protected $fillable = [
        'type',
        'prefix',
    ];

    protected array $searchable = [];

    protected array $sortable = [];

    public static function getPrefixByType($type){
        return self::where('type', $type)->first()?->prefix;
    }
}