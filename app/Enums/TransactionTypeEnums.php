<?php

namespace App\Enums;

class TransactionTypeEnums
{
    public const SALE = 'sale';
    public const EXPENSE = 'expense';
    public const REVENUE = 'revenue';
    public const MONEY_TRANSFER = 'money_transfer';
    public const MANUAL_JOURNAL = 'manual_journal';
    public const COMMISSION = 'commission';

    public static function getValues()
    {
        // Define transaction type
        return [
            self::SALE => 'sale',
            self::EXPENSE => 'expense',
            self::REVENUE => 'revenue',
            self::MONEY_TRANSFER => 'money_transfer',
            self::MANUAL_JOURNAL => 'manual_journal',
            self::COMMISSION => 'commission'
        ];
    }
}
