<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JournalEntry extends Model
{
    use HasFactory, BaseModel, SoftDeletes, DisplayNameTrait;

    protected $table = 'journal_entries';

    protected $fillable = [
        'transaction_id',
        'account_id',
        'amount',
        'current_balance',
        'entry_type',
        'notes',
        'payment_id'
    ];

    protected array $sortable = [
        'balance_amount',
        'debit_amount',
        'credit_amount',
        'currency',
        'notes',
    ];

    public function account() {
        return $this->belongsTo(Account::class);
    }
}
